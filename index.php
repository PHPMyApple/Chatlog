<?php 
    $WebsiteRoot=$_SERVER['DOCUMENT_ROOT'];
    $lang = 'de';
    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
    }
    $lang = ($lang == 'en' ? 'en' : 'de');
    
    $translation = json_decode(file_get_contents($WebsiteRoot.'/assets/translations/'.$lang.'.json'), true);
    
    include $WebsiteRoot.'/assets/php/header.php';
    require_once $WebsiteRoot.'/assets/php/utils.php';
    require_once $WebsiteRoot.'/assets/php/fillTemplate.php';
?>
    <section id="log-header">
        <div class="container grid">
            <div class="card--left">
                <div class="wrapper-left">
                    <?php
                        if (isset($_GET['id'])) {
                            $data = fetchDataFromRESTAPI($_GET['id']);
                        } else {
                            $data = fetchDataFromRESTAPI('not-existing');
                        }
                        fillTemplateHeader($data, $translation);
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section id="chatlog">
        <div id="chatlog-grid" class="container grid">
            <?php
                fillTemplateBody($data, $translation);
            ?>
        </div>
    </section>

<?php

    function fetchDataFromRESTAPI($id) {

	if (!$id || $id == 'not-existing') {
	    return getDefaultScreen();
        }
        
        $data = getChatlogFromID($id);
        
        if (count($data['chatlogMessages']) != 0) {
            // VALID ID
            $targetUUID = $data['targetUUID'];
            $creatorUUID = $data['creatorUUID'];
            
            $uuidsUsernames = array(
                $targetUUID=>uuidToUsername($targetUUID),
                $creatorUUID=>uuidToUsername($creatorUUID)
            );
            
            $chats = $data['chatlogMessages'];
            
            $servers = getListOfServers($chats);
            
            return array(
                'valid'=>true,
                'chats'=>$chats,
                'players'=>$uuidsUsernames,
                'targetUUID'=>$targetUUID,
                'creatorUUID'=>$creatorUUID,
                'creationTime'=>str_replace('T', ' ', $chats[count($chats)-1]['timestamp']),
                'servers'=>$servers,
                'svgOutlined'=>'3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V6c0-.55.45-1 1-1h8c.55 0 1 .45 1 1v12z',
                'svgFilled'=>'3V5c0-1.1-.9-2-2-2z',
            );

        } else {
            // INVALID ID
            return getDefaultScreen();
        }
        $conn->close();
    }

    function getDefaultScreen() {

            $fallbackUUID = '069a79f4-44e9-4726-a5be-fca90e38aaf5';

            $chats = array();
            $players = array(
              $fallbackUUID=>uuidToUsername($fallbackUUID)
            );
            $servers = array(
                'allServers'=>'server-1, server-2',
                'displayServers'=>'server-1, server-2'
            );
            return array(
                'valid'=>false,
                'chats'=>$chats,
                'players'=>$players,
                'targetUUID'=>$fallbackUUID,
                'creationTime'=>'00-00-0000 00:00:00',
                'servers'=>$servers
            );
    }

    include $WebsiteRoot.'/assets/php/footer.php';
?>
