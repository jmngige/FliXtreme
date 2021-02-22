<?php
    $hideNav = true;
    require_once("includes/header.php");

    if(!isset($_GET["id"])) {
        ErrorMessage::show("No ID passed into page");
    }

    $user = new User($con, $userLoggedIn);

    if(!$user->getIsSubscribed()) {
        ErrorMessage::show("<img src='owncloud/data/admin/files/assets/images/flixtreme.svg' style='width:20%;'><br><br>
                            Error - #74DQ3<br>
                            You must have an active subscription to stream content.
                            <br>
                            <a href='billing.php'>Click to here to subscribe now!</a>");
    }

    $video = new Video($con, $_GET["id"]);
    $video->incrementViews();

    $upNextVideo = VideoProvider::getUpNext($con, $video);
?>

<div class="watchContainer">
    <div class="videoControls watchNav">
        <button onclick="goBackToEntityPage(<?php echo $video->getEntityId(); ?>);"><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>

    <div class="videoControls upNext" style="display:none;">
        <button onclick="restartVideo();"><i class="fas fa-redo"></i></button>

        <div class="upNextContainer">
            <h2>Up Next:</h2>
            <?php if($upNextVideo->isMovie() == false) { ?>
            <h3><?php echo $upNextVideo->getEntityName(); ?></h3>    
            <?php } ?>
            <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>
            <h3><?php echo $upNextVideo->getTitle(); ?></h3>
            

            <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>);">
                <i class="fas fa-play"></i> Play
            </button>
        </div>
    </div>

    <video id="player" class="video-js" onended="showUpNext();" style="object-fit: fill;">
    <source src="<?php echo $video->getFilePath(); ?>" type="application/x-mpegURL" />
    <?php echo $video->getSubtitlesHTML(); ?>
    </video>

<script>
   var _0x422a=['0x31','length','0x4e','0x1c','0x4a','0x59','0x8','0x35','player','0x47','0x2','0xb','0x6','0x21','0x5b','0x5','0x37','0x2f','0x2a','0x14','0x1a','0x22','substring','0x19','0x43','0x54','innerHeight','0x24','0x3f','0x4f','0x1e','hls','0x32','videojs-contrib-quality-levels','shift','0x28','xhr','0x3','0xa','0x1','0x17','push','0x10','0x33','0x4c','0xf','0xd','0x57','0x18','KeyNum','0x1d','0x29','0x3e','0x3c','0x12','0x44','0x27','key://','0x51','0x20','0x1f','0x13','0x53','0x42','0x49','0x7','0x39','startsWith','0x25','0x45','0xc','0x40','0x34','videojs-hls-quality-selector','0x4','0x55','0x46','0x56','0x3b','0xe','0x48','0x2c','0x0','0x4d','0x52','0x4b','0x9','0x23','0x2d','0x15','videojs-seek-buttons','0x41','0x50','0x30','0x26','0x11','0x2e','0x36','innerWidth','0x38','0x16','0x2b','0x3d','0x1b','uri','0x5a','seekButtons','0x3a'];(function(_0x1412b9,_0x422ae6){var _0x2ad579=function(_0x441a68){while(--_0x441a68){_0x1412b9['push'](_0x1412b9['shift']());}};_0x2ad579(++_0x422ae6);}(_0x422a,0xb8));var _0x2ad5=function(_0x1412b9,_0x422ae6){_0x1412b9=_0x1412b9-0x0;var _0x2ad579=_0x422a[_0x1412b9];return _0x2ad579;};var _0x4efa=[_0x2ad5('0x11'),_0x2ad5('0x28'),_0x2ad5('0x2'),'0x28',_0x2ad5('0x54'),_0x2ad5('0x50'),_0x2ad5('0x16'),_0x2ad5('0x4a'),_0x2ad5('0x58'),'0x6',_0x2ad5('0x35'),'0x2','0x25',_0x2ad5('0x2b'),'video',_0x2ad5('0xd'),_0x2ad5('0x68'),'0x44',_0x2ad5('0x45'),_0x2ad5('0x29'),'0x21',_0x2ad5('0x18'),_0x2ad5('0x5d'),'0x7',_0x2ad5('0x44'),_0x2ad5('0x6a'),_0x2ad5('0xe'),_0x2ad5('0x5c'),_0x2ad5('0x56'),'beforeRequest','0x43',_0x2ad5('0x41'),_0x2ad5('0x3c'),_0x2ad5('0x67'),_0x2ad5('0x1b'),_0x2ad5('0x23'),'hlsQualitySelector',_0x2ad5('0x1f'),_0x2ad5('0x1a'),'0x3c','0x2f',_0x2ad5('0x3f'),_0x2ad5('0x4b'),_0x2ad5('0x4'),'0x37',_0x2ad5('0x52'),_0x2ad5('0x47'),_0x2ad5('0x63'),_0x2ad5('0x26'),'shift',_0x2ad5('0x46'),_0x2ad5('0x36'),_0x2ad5('0x4e'),_0x2ad5('0x59'),'0x23',_0x2ad5('0x3b'),_0x2ad5('0x32'),'headers',_0x2ad5('0x15'),_0x2ad5('0xc'),'0x0',_0x2ad5('0x3'),_0x2ad5('0x69'),_0x2ad5('0x3e'),'0x19',_0x2ad5('0x33'),_0x2ad5('0x5'),_0x2ad5('0x4d'),'0x2e',_0x2ad5('0x21'),_0x2ad5('0x1e'),_0x2ad5('0x53'),_0x2ad5('0x27'),'0x46',_0x2ad5('0x65'),_0x2ad5('0x1c'),_0x2ad5('0x3a'),'0x26',_0x2ad5('0x66'),_0x2ad5('0x34'),_0x2ad5('0x48'),'0x9',_0x2ad5('0x49'),_0x2ad5('0x40'),_0x2ad5('0x19'),'0x31',_0x2ad5('0x13'),'tech',_0x2ad5('0x2f'),_0x2ad5('0x17'),'loadstart','getKey.php'];(function(_0x2fe9c5,_0x5ce77e){var _0xab20a5=function(_0xf123c0){while(--_0xf123c0){_0x2fe9c5[_0x2ad5('0x49')](_0x2fe9c5[_0x2ad5('0x42')]());}};_0xab20a5(++_0x5ce77e);}(_0x4efa,0xd6));var _0xefe1=function(_0x136fac,_0x4581b9){_0x136fac=_0x136fac-0x0;var _0x535705=_0x4efa[_0x136fac];return _0x535705;};var _0x481a=[_0xefe1(_0x2ad5('0x48')),'0x2b',_0xefe1(_0x2ad5('0x34')),_0x2ad5('0x2c'),_0xefe1(_0x2ad5('0x24')),_0xefe1(_0x2ad5('0x2c')),_0xefe1(_0x2ad5('0x1b')),_0xefe1('0x27'),_0x2ad5('0x4a'),_0xefe1(_0x2ad5('0x55')),_0xefe1(_0x2ad5('0x5c')),_0xefe1(_0x2ad5('0x4f')),_0x2ad5('0x2a'),_0xefe1('0x1'),_0xefe1(_0x2ad5('0x1d')),_0xefe1(_0x2ad5('0x18')),_0x2ad5('0x50'),_0xefe1(_0x2ad5('0x2e')),_0xefe1(_0x2ad5('0x5e')),_0x2ad5('0x1b'),_0xefe1(_0x2ad5('0x7')),_0xefe1(_0x2ad5('0x12')),_0x2ad5('0x48'),_0xefe1('0x58'),_0xefe1(_0x2ad5('0x25')),_0xefe1(_0x2ad5('0xf')),_0xefe1(_0x2ad5('0x50')),_0xefe1(_0x2ad5('0x4c')),_0xefe1(_0x2ad5('0x1f')),_0xefe1(_0x2ad5('0x5b')),_0xefe1(_0x2ad5('0x14')),_0xefe1(_0x2ad5('0x33')),_0xefe1('0x3d'),_0xefe1('0x55'),_0xefe1(_0x2ad5('0x57')),_0x2ad5('0x52'),_0xefe1(_0x2ad5('0x4')),_0xefe1(_0x2ad5('0x10')),_0xefe1('0x10'),_0xefe1('0x46'),_0xefe1(_0x2ad5('0x37')),_0xefe1(_0x2ad5('0x56')),_0xefe1(_0x2ad5('0x2d')),_0xefe1(_0x2ad5('0xd')),_0xefe1(_0x2ad5('0x30')),_0xefe1(_0x2ad5('0x66')),_0xefe1('0x33'),_0xefe1(_0x2ad5('0x17')),_0xefe1(_0x2ad5('0x3e')),_0xefe1(_0x2ad5('0x35')),_0xefe1('0x29'),_0xefe1(_0x2ad5('0x54')),_0xefe1(_0x2ad5('0x2b')),_0xefe1(_0x2ad5('0xc')),_0xefe1(_0x2ad5('0x39')),_0xefe1('0x4b'),_0x2ad5('0x40'),_0xefe1('0xa'),_0xefe1(_0x2ad5('0x1')),_0xefe1(_0x2ad5('0xb')),_0xefe1(_0x2ad5('0x20')),_0xefe1(_0x2ad5('0x3b')),_0xefe1(_0x2ad5('0x8')),_0x2ad5('0x5b'),_0xefe1(_0x2ad5('0x2f')),_0xefe1(_0x2ad5('0x3c')),_0x2ad5('0x66'),_0xefe1('0x39'),_0xefe1(_0x2ad5('0x5d')),_0xefe1(_0x2ad5('0x68')),_0xefe1(_0x2ad5('0x64')),_0xefe1(_0x2ad5('0x52')),_0xefe1(_0x2ad5('0x13'))];(function(_0x43aebc,_0x1da990){var _0x468775=function(_0x2bf441){while(--_0x2bf441){_0x43aebc[_0xefe1(_0x2ad5('0x68'))](_0x43aebc[_0xefe1(_0x2ad5('0x5d'))]());}};_0x468775(++_0x1da990);}(_0x481a,0x145));var _0x8b23=function(_0x3813c5,_0x464790){_0x3813c5=_0x3813c5-0x0;var _0x245f1f=_0x481a[_0x3813c5];return _0x245f1f;};var _0x3a60=[_0xefe1('0x33'),_0x8b23(_0xefe1('0x4a')),_0x8b23(_0x2ad5('0x5b')),_0xefe1(_0x2ad5('0x5e')),_0x8b23(_0xefe1(_0x2ad5('0x19'))),_0x8b23(_0xefe1(_0x2ad5('0x5'))),_0x8b23(_0xefe1(_0x2ad5('0x0'))),_0xefe1('0x4b'),_0x8b23(_0xefe1(_0x2ad5('0x35'))),_0x8b23(_0x2ad5('0x6')),_0x8b23(_0xefe1(_0x2ad5('0x25'))),_0x8b23(_0xefe1(_0x2ad5('0x39'))),_0x2ad5('0x5c'),_0x8b23(_0xefe1('0x3b')),_0x8b23(_0xefe1(_0x2ad5('0x54'))),_0x8b23(_0xefe1(_0x2ad5('0x60'))),_0xefe1(_0x2ad5('0xb')),_0x8b23(_0xefe1(_0x2ad5('0x67'))),_0x8b23(_0xefe1(_0x2ad5('0x4'))),_0x8b23(_0xefe1(_0x2ad5('0x4a'))),_0x8b23(_0xefe1(_0x2ad5('0x22'))),_0x8b23(_0xefe1(_0x2ad5('0x27'))),_0x8b23(_0x2ad5('0x62')),_0x8b23(_0xefe1('0x26')),_0x8b23(_0xefe1(_0x2ad5('0x50'))),_0x8b23(_0x2ad5('0x31')),_0xefe1(_0x2ad5('0x1f')),_0x8b23(_0x2ad5('0x3e')),_0x8b23(_0xefe1(_0x2ad5('0x23'))),_0x8b23(_0xefe1(_0x2ad5('0x30'))),_0xefe1(_0x2ad5('0x43')),_0xefe1('0x1e'),_0x8b23(_0xefe1('0x4d')),_0x8b23(_0xefe1(_0x2ad5('0x65'))),_0x8b23(_0xefe1(_0x2ad5('0x8'))),_0x8b23(_0xefe1(_0x2ad5('0x3'))),_0x8b23(_0x2ad5('0x45')),_0xefe1(_0x2ad5('0x8')),_0xefe1(_0x2ad5('0x40')),_0x8b23(_0x2ad5('0x55')),_0x8b23(_0xefe1(_0x2ad5('0x15'))),_0x8b23(_0xefe1(_0x2ad5('0x6a'))),_0x8b23(_0xefe1(_0x2ad5('0x2a'))),_0x8b23(_0xefe1(_0x2ad5('0x33'))),_0x8b23(_0xefe1(_0x2ad5('0x56'))),_0xefe1(_0x2ad5('0x68')),_0x8b23(_0xefe1(_0x2ad5('0x4f'))),_0x8b23(_0xefe1(_0x2ad5('0x4e'))),_0x8b23(_0xefe1('0x51')),_0x8b23('0xe'),_0x8b23(_0xefe1('0x0')),_0x8b23(_0xefe1(_0x2ad5('0x66')))];(function(_0x5c8c46,_0x19176f){var _0x302354=function(_0x53fd33){while(--_0x53fd33){_0x5c8c46[_0x8b23(_0xefe1('0x19'))](_0x5c8c46[_0x8b23(_0xefe1(_0x2ad5('0x50')))]());}};_0x302354(++_0x19176f);}(_0x3a60,0x7e));var _0x24db=function(_0x5c628d,_0x58e005){_0x5c628d=_0x5c628d-0x0;var _0x2032df=_0x3a60[_0x5c628d];return _0x2032df;};var _0x1676=[_0x24db(_0x8b23(_0x2ad5('0x48'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x1d')))),_0x24db(_0x8b23('0x9')),_0x24db(_0x8b23(_0x2ad5('0x4b'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x5a')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x3b')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x1f')))),_0x24db(_0x8b23('0x34')),_0x8b23(_0xefe1(_0x2ad5('0x52'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x64')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x25')))),_0x24db(_0x8b23(_0x2ad5('0x3e'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x60')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x56')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x4f')))),_0x24db(_0xefe1(_0x2ad5('0x4b'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x9')))),_0x24db(_0xefe1(_0x2ad5('0x31'))),_0x8b23(_0xefe1(_0x2ad5('0x1f'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x10')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x2')))),_0x24db(_0x8b23(_0x2ad5('0x1b'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x20')))),_0x8b23(_0xefe1(_0x2ad5('0xb'))),_0x24db(_0x8b23(_0xefe1('0x30'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x15')))),_0x24db(_0x8b23(_0x2ad5('0x5f'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0xa')))),_0x8b23(_0xefe1(_0x2ad5('0xf'))),_0x24db(_0x8b23(_0x2ad5('0x15'))),_0x24db(_0x8b23(_0xefe1('0xe'))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x65')))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x17')))),_0x8b23(_0xefe1(_0x2ad5('0x32'))),_0x24db(_0x8b23(_0xefe1('0x7')))];(function(_0x3e8c2a,_0x2d4e67){var _0x5906f4=function(_0x12418e){while(--_0x12418e){_0x3e8c2a[_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x5f'))))](_0x3e8c2a[_0x8b23(_0xefe1(_0x2ad5('0x50')))]());}};_0x5906f4(++_0x2d4e67);}(_0x1676,0x9b));var _0x4dd6=function(_0x567d5a,_0x562dcd){_0x567d5a=_0x567d5a-0x0;var _0x24cd3f=_0x1676[_0x567d5a];return _0x24cd3f;};var _0x4d7a=[_0x4dd6(_0xefe1(_0x2ad5('0x2d'))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x3'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x60'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x34'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x24'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x8'))))),_0x2ad5('0x51'),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x7'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1('0x35')))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x5c'))))),_0x4dd6(_0x8b23(_0xefe1(_0x2ad5('0x1f')))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x29'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x31'))))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x6b')))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x61'))))),_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x3e')))),_0x4dd6(_0x8b23(_0xefe1(_0x2ad5('0x5c')))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x40'))))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x2f'))))),_0x4dd6(_0x24db(_0x8b23(_0x2ad5('0xf'))))];(function(_0x411ea8,_0x2445e9){var _0x1448d1=function(_0x51e05a){while(--_0x51e05a){_0x411ea8[_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x5f'))))](_0x411ea8[_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x38')))))]());}};_0x1448d1(++_0x2445e9);}(_0x4d7a,0x184));var _0x2203=function(_0x125e53,_0x462c8e){_0x125e53=_0x125e53-0x0;var _0x33b64b=_0x4d7a[_0x125e53];return _0x33b64b;};requirejs([_0x2203(_0x24db(_0x8b23(_0x2ad5('0x2d')))),_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1('0xc'))))),_0x4dd6(_0x24db(_0xefe1(_0x2ad5('0x24')))),_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x15')))))],function(_0x2c386e){var _0x2f3cb2=_0x2c386e(_0x2203(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x45'))))),{'controls':!![],'autoplay':!![],'preload':!![],'playbackRates':[0.25,0.5,0.75,0x1,1.5,0x2,0x4],'height':window[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x4b'))))))],'width':window[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1('0x8')))))],'html5':{'nativeAudioTracks':![],'nativeVideoTracks':![],'hls':{'debug':!![],'overrideNative':!![]}}});var _0x35f6b4=_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x45'))))));var _0x29d9f4=_0x2203(_0x4dd6(_0x24db(_0xefe1(_0x2ad5('0x1d')))));_0x2f3cb2['on'](_0x2203(_0x24db(_0x8b23(_0xefe1('0x47')))),function(_0x2072f7){_0x2f3cb2[_0x2203(_0x4dd6(_0xefe1('0x50')))]()[_0x2203(_0x4dd6(_0x24db(_0xefe1(_0x2ad5('0x33')))))][_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x4d'))))))][_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x3d'))))))]=function(_0x329595){if(!_0x329595[_0x2203(_0x4dd6(_0x24db(_0x8b23('0xc'))))][_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x54'))))))](_0x35f6b4)){return;}_0x329595[_0x2203(_0x4dd6('0x18'))]=_0x329595[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x53'))))))]||{};_0x329595[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x53'))))))][_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1('0x4')))))]=atob(_0x329595[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1('0x30')))))][_0x2203(_0x24db(_0x8b23(_0xefe1('0x40'))))](_0x35f6b4[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x18'))))))]));_0x329595[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x11'))))))]=_0x29d9f4;};});_0x2f3cb2[_0x2203(_0x8b23(_0xefe1(_0x2ad5('0x54'))))]({'forward':0x1e,'back':0xa});_0x2f3cb2[_0x2203(_0x4dd6(_0x24db(_0x8b23(_0xefe1(_0x2ad5('0x5e'))))))]({'displayCurrentQuality':![]});});
</script>
</div>

<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
</script>