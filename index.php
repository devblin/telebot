<?php
require __DIR__ . "/mysql_func.php";
$bot_tokken = env('API_KEY');

$update = file_get_contents("php://input");
$update = json_decode($update, true);
$userId = isset($update["message"]["from"]["id"]) ? $update["message"]["from"]["id"] : null;
$commands = "/help - To see all commands.\n/send to GROUP_NAME msg YOUR_MESSAGE - To send message to group.\n/show - To get lists of groups.";

$newBot =  new Bot();

$chatId = isset($update["message"]["chat"]["id"]);
if ($chatId) {
    $chatId = $update["message"]["chat"]["id"];

    $chatName = isset($update['message']['chat']['title']) ? $update['message']['chat']['title'] : null;
    $name = $update['message']['from']['first_name'];
    $msg = "Hello I am devblin_bot and here is your ID:" . $chatId;

    if (isset($update["message"]["text"]) && isset($update["message"]["entities"])) {
        $commandRecieved = $update['message']['text'];
        if ($commandRecieved == "/help") {
            $params  = setParams($userId, $commands);
            CURL("sendMessage", $params);
        } else if ($commandRecieved == "/start") {
            $msg = "Hello, I am devblin_bot of Deepanshu Dhruw. Send /help for commands";
            $params = setParams($userId, $msg);
            CURL("sendMessage", $params);
        } else if ($commandRecieved  == "/show") {
            $data = $newBot->getGroups($userId);
            if ($data != null) {
                $msg = "Groups:\n";
                $msg .= "---------\n";
                for ($i = 0; $i < count($data); $i++) {
                    $msg .= $data[$i]['GROUPNAME'] . "\n";
                }
            } else {
                $msg = "I am not member in any group :(";
            }
            $params = setParams($userId, $msg);
            CURL("sendMessage", $params);
        } else if (strpos($commandRecieved, "/send") == 0) {
            $commGiven = $commandRecieved;
            $comm = explode(" to ", $commGiven);
            if ($comm[0] == "/send") {
                $comm1  = explode(" msg ", $comm[1]);
                $groupName = trim($comm1[0]);
                $msgTosend = $comm1[1];
                $grpId = $newBot->getGroupId($groupName, $userId);
                if ($grpId != null) {
                    $params = setParams($grpId, $msgTosend);
                    CURL("sendMessage", $params);
                } else {
                    $params = setParams($chatId, "Sorry, can't find that group,\ncheck if I am member in that group.\nIf not please add me in that group.");
                    CURL("sendMessage", $params);
                }
            } else {
                $params = setParams($chatId, "Refer to /help for command details.");
                CURL("sendMessage", $params);
            }
        } else {
            $newBot->addNewUser($userId, $chatName);
        }
    } else if (isset($update["message"]["new_chat_participant"]["username"])) {
        if ($update["message"]["new_chat_participant"]["username"] == "devblin_bot") {
            $newBot->addNewUser($userId, $name);
            $newBot->addNewGroup($userId, $chatId, $chatName);
        }
    } else {
        $newBot->addNewUser($userId, $name);
    }
}

function CURL($method, $data)
{
    global $bot_tokken;
    $curl = curl_init();
    $url  = "https://api.telegram.org/bot{$bot_tokken}/{$method}";
    curl_setopt_array($curl, array(
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}


class Bot
{
    function getGroups($userid)
    {
        $sql = "SELECT * FROM groups WHERE USERID=?";
        $data = getArray($sql, "i", array($userid));
        if (is_array($data)) {
            return $data;
        } else {
            return null;
        }
    }
    function addNewUser($userid, $username)
    {
        $sql = "SELECT * FROM users WHERE USERID=?";
        $checkUser = checkData($sql, "i", array($userid));
        if ($checkUser == 0) {
            $sql  = "INSERT INTO users(USERID,USERNAME) VALUES(?,?)";
            opData($sql, "is", array($userid, $username));
        }
    }

    function addNewGroup($userid, $groupid, $groupname)
    {
        $sql = "SELECT * FROM users WHERE USERID=?";
        $checkUser = checkData($sql, "i", array($userid));
        if ($checkUser == 1) {
            $sql = "SELECT * FROM groups WHERE GROUPID=?";
            $checkGroup = checkData($sql, "i", array($groupid));
            if ($checkGroup == 0) {
                $sql = "INSERT INTO groups(USERID,GROUPID,GROUPNAME) VALUES(?,?,?)";
                opData($sql, "iss", array($userid, $groupid, $groupname));
            }
        }
    }

    function getGroupId($groupname, $userid)
    {
        $sql = "SELECT * FROM groups WHERE GROUPNAME=? AND USERID=?";
        $data = getArray($sql, "si", array($groupname, $userid));
        if (is_array($data)) {
            return $data[0]['GROUPID'];
        } else {
            return null;
        }
    }
}

function setParams($chatid, $msg)
{
    $params = array(
        "chat_id" => $chatid,
        "text" => $msg
    );
    return $params;
}