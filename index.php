<?php
/*********************************************/
/* (c) by HideClick - bot protection service */
/* By using you agree to the GNU AGPLv3 terms*/
/*********************************************/

/* Отредактируйте обязательные настройки     */
$CLOAKING['WHITE_PAGE'] = 'index.html';//PHP или HTML файл для ботов и модераторов
$CLOAKING['OFFER_PAGE'] = 'black.html';//PHP или HTML файл с оффером/лендингом для пользователей на которых таргетируемся.
$CLOAKING['DEBUG_MODE'] = 'on';// замените "on" на "off" после тестирования настроек хостинга чтобы отключить режим самотестирования.
/*********************************************/
/* Доступные дополнительные настройки        */
/* Режим "гео фильтрации": показывает OFFER_PAGE (лендинг) только пользователям из разрешенных стран.  */
/* пропишите в следующей строке 2х буквенные коды стран которым можно показывать ленд */
 $CLOAKING['ALLOW_GEO'] = 'AU';
/* Передача UTM меток */
/* доступные значения: true - включить передачу меток; false - выключить */
 $CLOAKING['UTM'] = true;
/* Настройки методов отображения OFFER_PAGE если в качестве OFFER_PAGE используется ссылка. Возможные значения: meta, 302, iframe */
/* 'meta' - редиректит через мета-рефреш (дефолтный метод из за максимальной совместимости с разными хостингами). */
/* '302' -  редиректит через 302 редирект (рекомендуемый метод если цель - максимум переходов)*/
/* 'iframe' - подгружает OFFER_PAGE через iframe оставляя пользователя на текущей странице (рекомендуемый метод для рекламы в inApp (инстаграм) */
/* пропишите в следующей строке один из вариантов: meta, 302, iframe  */
 $CLOAKING['OFFER_METHOD'] = 'meta';
/* Настройки методов отображения WHITE_PAGE если в качестве WHITE_PAGE используется ссылка. Возможные значения: curl, 302 */
/* 'curl' - скрипт скачивает страницу WHITE_PAGE с удаленного сервера и показывает на вашем домене (метод по умолчанию) */
/* '302' -  скрипт редиректит запрос на сторонний сервер и бот видит WHITE_PAGE на чужом домене (метод для ФБ и трастовых доменов) */
/* пропишите в следующей строке один из вариантов: curl, 302 */
 $CLOAKING['WHITE_METHOD'] = 'curl';
/* NO_REF блокирует запросы с пустым рефером, рекомендуется только если весь трафик идет с рекламной кампании в поиске (yandex, google) */
/* измените значение в следующей строке с false на true, чтобы включить блокирование пустого реферера */
$CLOAKING['NO_REF'] = false;
/* WHITE_REF позволяет заблокировать все запросы у которых рефрер не совпадает с регулярным выражением.*/
/* Например регулярное выражение 'google|facebook' заблокирует все визиты кроме тех, которые пришли гугла или фейсбука */
$CLOAKING['WHITE_REF'] = '';
/* Следующие настройки позволяют заблокировать запросы с определенных устройств */
/* чтобы заблокировать запросы с устройств APPLE измените значение в следующей строке с false на true */
$CLOAKING['BLOCK_APPLE'] = false;
/* чтобы заблокировать запросы с устройств Android измените значение в следующей строке с false на true */
$CLOAKING['BLOCK_ANDROID'] = false;
/* чтобы заблокировать запросы с устройств Windows измените значение в следующей строке с false на true */
$CLOAKING['BLOCK_WIN'] = false;
/* чтобы заблокировать запросы с мобильных устройств измените значение в следующей строке с false на true */
$CLOAKING['BLOCK_MOBILE'] = false;
/* чтобы заблокировать запросы с десктопов измените значение в следующей строке с false на true */
$CLOAKING['BLOCK_DESCTOP'] = true;
/* режжим DELAY_START показывает первым Х уникальным посетителям вайтпейдж (независимот от других настроек) */
$CLOAKING['DELAY_START'] = 0;
/* режжим DELAY_PERMANENT перманентно банит IP адреса первых Х посетителей */
$CLOAKING['DELAY_PERMANENT'] = false;
/* Режим "паранойи": блокирует spy / verification сервисы использующие residential proxy, но при этом в некоторых гео может блокировать реальных пользователей. */
/* чтобы включить режим "паранойи" измените значение в следующей строке с false на true */
$CLOAKING['PARANOID'] = false;

/* Следующие настройки нужны только если у вас не стандартный хостинг и что-то не работает */
/* удалите символы "//" в начале следующей строки если клоака не работает и сайт использует CDN, Varnish или другой кеширующий прокси */
//$CLOAKING['DISABLE_CACHE'] = true;
/*********************************************/
/* Ваш API ключ. Храните его в секрете!      */
/* DO NOT SHARE API KEY! KEEP IT SECRET!     */
$CLOAKING['API_SECRET_KEY'] = 'v1c1079cd72f084563ad74c653a4b5e286';// ключ доступа к API.
/*********************************************/
// Не вносите изменения в дальнейший код (по крайней мере если вы не PHP програмист)
// DO NOT EDIT ANYTHING BELOW !!!
if(!empty($CLOAKING['VERSION']) || !empty($GLOBALS['CLOAKING']['VERSION'])) die('Recursion Error');
//$CLOAKING['VERSION']=20200115;
$CLOAKING['VERSION']=20200303;
//$CLOAKING['HTACCESS_FIX'] = true;

$errorContactMessage="<br><br>Need help? Contact us by telegram: <a href=\"tg://resolve?domain=hideclick\">@hideclick</a><br>Что-то пошло не так. Если вам нужна помощь свяжитесь с нами в телеграме: <a href=\"tg://resolve?domain=hideclick\">@hideclick</a><br>";
if(!empty($_GET['utm_allow_geo']) && preg_match('#^[a-zA-Z]{2}(-|$)#',$_GET['utm_allow_geo'])) $CLOAKING['ALLOW_GEO']=$_GET['utm_allow_geo'];
if(empty($CLOAKING['PARANOID'])) $CLOAKING['PARANOID']='';
if(empty($CLOAKING['ALLOW_GEO'])) $CLOAKING['ALLOW_GEO']='';
if(empty($CLOAKING['HTACCESS_FIX'])) $CLOAKING['HTACCESS_FIX']='';
if(empty($CLOAKING['DISABLE_CACHE'])) $CLOAKING['DISABLE_CACHE']='';
else {
    setcookie("euConsent", 'true');
    setcookie("BC_GDPR", time());
    header( "Cache-control: private, max-age=0, no-cache, no-store, must-revalidate, s-maxage=0" );
    header( "Pragma: no-cache" );
    header( "Expires: ".date('D, d M Y H:i:s',rand(1560500925,1571559523))." GMT");
}

if(!empty($_REQUEST['cloaking'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if ($_REQUEST['cloaking'] == 'stat' || $_REQUEST['cloaking'] == 'stats') {
        if(empty($CLOAKING['API_SECRET_KEY'])||strlen($CLOAKING['API_SECRET_KEY'])<16) {
            echo '<html><head><meta charset="UTF-8"></head><body><b>Ошибка: не указан секретный API ключ!</b><br>Пропишите ваш ключ (вы сможете найти его в почте, или предыдущей версии скрипта) в строке <b>#'.cloakedEditor("\$CLOAKING['API_SECRET_KEY']").'</b> чтобы получилось:<br><code>$CLOAKING[\'API_SECRET_KEY\'] = \'ТУТ ВАШ КЛЮЧ\';</code><br>'.$errorContactMessage;
            die();
        }
        setcookie("hideclick", 'ignore', time()+604800);
        if(!empty($_SERVER['HTTP_HOST'])) $host=$_SERVER['HTTP_HOST'];
        else if(!empty($_SERVER['Host'])) $host=$_SERVER['Host'];
        else if(!empty($_SERVER['host'])) $host=$_SERVER['host'];
        else if(!empty($_SERVER[':authority'])) $host=$_SERVER[':authority'];
        else $host='';
        if(!empty($_SERVER['REQUEST_URI'])) $host.=$_SERVER['REQUEST_URI'];
        if(stristr($host,'?')) $host=substr(0,strpos($host,'?'));
        if(substr($host,0,4)=='www.') $host=substr($host,4);
        $domainStat='';
        if(!empty($_REQUEST['domain'])) $domainStat.='&domain='.$_REQUEST['domain'];
        if(!empty($_REQUEST['date2'])) $domainStat.='&date2='.$_REQUEST['date2'];//timestamp
        else $domainStat.='&date2='.time();
        if(!empty($_REQUEST['date1'])) $domainStat.='&date1='.$_REQUEST['date1'];//timestamp
        else $domainStat.='&date1='.(time()-604800);
        if (!function_exists('curl_init')) $statistic = file_get_contents('https://hideapi.xyz/newstat?api=' . $CLOAKING['API_SECRET_KEY'] . '&lang=ru&sign=929319014271f1585231639&version='.$CLOAKING['VERSION'].'&js=false&cache='.$CLOAKING['DISABLE_CACHE'].'&geo=' . urlencode($CLOAKING['ALLOW_GEO']) . '&paranoid=' . $CLOAKING['PARANOID'] . '&host=' . urlencode($host) . '&white=' . urlencode($CLOAKING['WHITE_PAGE']) . '&offer=' . urlencode($CLOAKING['OFFER_PAGE']).$domainStat, 'r', stream_context_create(array('http' => array('method' => 'GET', 'timeout' => 45), 'ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,) )) );
        else $statistic = cloakedCurl('https://hideapi.xyz/newstat?api=' . $CLOAKING['API_SECRET_KEY'] . '&lang=ru&sign=929319014271f1585231639&version='.$CLOAKING['VERSION'].'&js=false&cache='.$CLOAKING['DISABLE_CACHE'].'&geo=' . urlencode($CLOAKING['ALLOW_GEO']) . '&paranoid=' . $CLOAKING['PARANOID'] . '&host=' . urlencode($host) . '&white=' . urlencode($CLOAKING['WHITE_PAGE']) . '&offer=' . urlencode($CLOAKING['OFFER_PAGE']).$domainStat);
        echo $statistic;
        if (empty($statistic)) echo "<html><head><meta charset=\"UTF-8\"></head><body>".$errorContactMessage;
    }
    else if ($_REQUEST['cloaking'] == 'white') cloakedWhitePage($CLOAKING['WHITE_PAGE'],$CLOAKING['WHITE_METHOD']);
    else if ($_REQUEST['cloaking'] == 'offer') cloakedOfferPage($CLOAKING['OFFER_PAGE'],$CLOAKING['OFFER_METHOD']);
    else if ($_REQUEST['cloaking'] == 'debug') {phpinfo();print_r(debug_backtrace ());$CLOAKING['API_SECRET_KEY']=1;print_r($CLOAKING);die();}
    else if ($_REQUEST['cloaking'] == 'time') {
        header( "Cache-control: public, max-age=999999, s-maxage=999999" );
        header( "Expires: Wed, 21 Oct 2025 07:28:00 GMT" );
        echo str_replace(" ","",rand(1,10000).microtime().rand(1,100000));
    }
    die();
}
// так как большинство пользователей косячит, пришлось ввести режим настройки...
// если у вас в команде нормальный админ и програмист, это можно удалить
else if($CLOAKING['DEBUG_MODE'] == 'on'){
    set_time_limit(5);
    ini_set('max_execution_time',5);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $error=0;
    setcookie("hideclick", 'ignore', time()+604800);
    // не можем использовать $_SERVER["REDIRECT_URL"], так как есть сервера у которых этот параметр используется даже без редиректа.
    if(!empty($_GET) || !empty($_POST) || ($_SERVER["SCRIPT_NAME"]!=$_SERVER["REQUEST_URI"] && $_SERVER["REQUEST_URI"]!=str_replace("index.php","",$_SERVER["SCRIPT_NAME"]))) {
        echo "<html><head><meta charset=\"UTF-8\"></head><body>Error with rewrite engine.<!--//'".$_SERVER["SCRIPT_NAME"]."'!='".$_SERVER["REQUEST_URI"]."'//-->".$errorContactMessage;
        die();
    }
    echo '<html><head><meta charset="UTF-8"><style type="text/css">body, html {font-family: Calibri, Ebrima;}img {margin-left:2em;opacity: 0.25;}img:hover {opacity: 1.0;}</style></head><body><b>Поздравляем.</b><br>Вы стали на один шаг ближе к новому уровню работы с рекламными сетями.<br><br><b>Давайте убедимся, что всё настроено правильно:</b><br>';
    if(is_file($CLOAKING['WHITE_PAGE'])) echo '✔ WHITE_PAGE - ок. <a target="_blank" href="?cloaking=white">Нажмите чтобы открыть WHITE_PAGE</a>. Убедитесь что страница отображается правильно.<br>';
    else if(strstr($CLOAKING['WHITE_PAGE'],'://')) echo '✔ WHITE_PAGE - ок. Настоятельно рекомендуем хранить WHITE_PAGE у себя на сайте! <a target="_blank" href="?cloaking=white">Нажмите чтобы открыть WHITE_PAGE</a>. Убедитесь что страница отображается правильно.<br>';
    else {echo '❌ WHITE_PAGE - ошибка! Измените значение в строке <b>#'.cloakedEditor("\$CLOAKING['WHITE_PAGE']").'</b> на страницу которая будет показываться ботам<br><img src="http://hide.click/gif/white.gif" border="1"><br>';$error=1;}

    if(is_file($CLOAKING['OFFER_PAGE']) || strstr($CLOAKING['OFFER_PAGE'],'://')) echo '✔ OFFER_PAGE - ок. <a target="_blank" href="?cloaking=offer">Нажмите чтобы открыть OFFER_PAGE</a>. Убедитесь что страница отображается правильно.<br>';
    else {echo '❌ OFFER_PAGE - ошибка! Измените значение в строке <b>#'.cloakedEditor("\$CLOAKING['OFFER_PAGE']").'</b> на страницу которая будет показываться реальным людям<br><img src="http://hide.click/gif/black.gif" border="1"><br>';$error=1;}
    $CLOAKINGdata=array();
    if(!function_exists('curl_init')) $CLOAKING['STATUS'] = @file_get_contents('http://api.hideapi.xyz/basic?ip=1.1.1.1&port=1111&key='.$CLOAKING['API_SECRET_KEY'].'&sign=929319014271f1585231639&version='.$CLOAKING['VERSION'].'&curl=false&js=false&cache='.$CLOAKING['DISABLE_CACHE'].'&htaccess='.$CLOAKING['HTACCESS_FIX'] , 'r', stream_context_create(array('ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,), 'http' => array('method' => 'POST', 'timeout' => 5, 'header'=> "Content-type: application/x-www-form-urlencoded\r\n". "Content-Length: ".strlen($CLOAKINGdata). "\r\n", 'content' => $CLOAKINGdata))));
    else $CLOAKING['STATUS'] = @cloakedCurl('http://api.hideapi.xyz/basic?ip=1.1.1.1&port=1111&key='.$CLOAKING['API_SECRET_KEY'].'&sign=929319014271f1585231639&version='.$CLOAKING['VERSION'].'&curl=true&js=false&cache='.$CLOAKING['DISABLE_CACHE'].'&htaccess='.$CLOAKING['HTACCESS_FIX'], $CLOAKINGdata);

    if(!$CLOAKING['STATUS'] || stristr($CLOAKING['STATUS'],'error')){
        //if(empty($CLOAKING['USE_CURL'])) echo '❌ PHP сконфигурирован неправильно. Уберите символы <b>//</b> в начале строки <b>#'.cloakedEditor("\$CLOAKING['USE_CURL']").'</b>. чтобы включить режим "USE_CURL".<br><img src="http://hide.click/gif/curl.gif" border="1"><br>';
        echo '❌ PHP сконфигурирован неправильно. Обратитесь в поддержку хостинга и попросите их включить поддержку CURL для РНР.<br>';
        $error=1;
    }
    if(stristr($CLOAKING['STATUS'],'payment')||stristr($CLOAKING['STATUS'],'expired')){
        echo '❌ Срок действия вашего секретного API ключа завершился. Обратитесь в саппорт для продления сервиса!<br>';
        $error=1;
    }
    $CLOAKING['STATUS'] = json_decode($CLOAKING['STATUS'], true);
    if(empty($CLOAKING['STATUS']) || empty($CLOAKING['STATUS']['action'])){
        echo '❌ PHP сконфигурирован неправильно.  Обратитесь в поддержку.<br>';
        $error=1;
    }

    // надо проверить кеширование на сервере...
    $testUrl= ( $_SERVER["SERVER_PORT"]==443 || (!empty($_SERVER['HTTP_CF_VISITOR']) && stristr($_SERVER['HTTP_CF_VISITOR'],'https') )) ? 'https://' : 'http://';
    // не можем использовать $_SERVER['HTTP_HOST'], так как потом возникают косяки из-за CDN
    $queryBug=strpos($_SERVER["REQUEST_URI"],'?');
    if(empty($_SERVER["SERVER_NAME"]) || $_SERVER["SERVER_NAME"] == '_' || $_SERVER["SERVER_NAME"] == 'localhost') $_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
    if($queryBug>0) $testUrl.=$_SERVER["SERVER_NAME"].substr($_SERVER["REQUEST_URI"],0,$queryBug).'?cloaking=time';
    else $testUrl.=$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].'?cloaking=time';
    $http_response_header=array();
    $static1 = !function_exists('curl_init') ? file_get_contents($testUrl,'r', stream_context_create(array('http' => array('method' => 'GET', 'timeout' => 5), 'ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,))) ) : cloakedCurl($testUrl);
    $static2 = !function_exists('curl_init') ? file_get_contents($testUrl,'r', stream_context_create(array('http' => array('method' => 'GET', 'timeout' => 5), 'ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,))) ) : cloakedCurl($testUrl);
    $static3 = !function_exists('curl_init') ? implode("\n",$http_response_header) : cloakedCurl($testUrl,'',true);
    // Set-Cookie vs empty($CLOAKING['DISABLE_CACHE']) || !empty($CLOAKING['DISABLE_CACHE']) ???
    if(preg_match('#Proxy|Microcachable#i',$static3) || (empty($CLOAKING['DISABLE_CACHE']) && preg_match('#Set-Cookie#i', $static3) && !strstr($static3, '__cfduid=')) ){
        echo '❌ Плохая конфигурация сервера. Свяжитесь с нами. Мы поможем. Нам не сложно.<br><br>';
    }
    else if($static1>0 && $static2>0 && $static1<=100000  && $static2<=100000 && $static1!=$static2) {}
    else if(empty($static1)||empty($static2)) {
        echo '❌ Нестандартная конфигурация сервера. Свяжитесь с нами. Мы поможем в настройке. Нам не сложно.<br><br>';
        $error=1;
    }
    else if(!empty($CLOAKING['DISABLE_CACHE'])) {
        echo '❌ Сервер сконфигурирован неправильно. Попросите поддержку хостинга выключить кеширование (или смените хостинг провайдера).<br><br>';
        $error=1;
    }
    else {
        echo '❌ Сервер сконфигурирован неправильно. Уберите символы <b>//</b> в начале строки <b>#'.cloakedEditor("\$CLOAKING['DISABLE_CACHE']").'</b> чтобы включить режим "DISABLE_CACHE".<br><img src="http://hide.click/gif/cache.gif" border="1"><br><br>';
        $error=1;
    }
    if(preg_match('#[^A-Za-z ,]+#',$CLOAKING['ALLOW_GEO'])) {
        echo '❌ Гео фильтр настроен неправильно. В строке <b>#'.cloakedEditor("\$CLOAKING['ALLOW_GEO']").'</b> могут быть только буквы A-Z (2х буквенные коды стран) и запятые.<br><img src="http://hide.click/gif/geo.gif" border="1"><br>';
        $error=1;
    }
    if($CLOAKING['DELAY_START']) {
        file_put_contents('dummyCounter.txt','');
        if(!is_file('dummyCounter.txt') || !is_writable('dummyCounter.txt')) {
            echo '❌ Для работы опции DELAY_START необходимо создать в директории <b>'.getcwd().'</b> на сервере файл <b>dummyCounter.txt</b> с правами на запись.<br>';
            $error = 1;
        }
    }

    if($error) { echo "<br><b>Исправьте ошибки и перезагрузите страницу.</b><br><br>Нужна помощь? Напишите нам в телеграм: <a href=\"tg://resolve?domain=hideclick\">@hideclick</a>";die(); }

    if(empty($CLOAKING['ALLOW_GEO'])) echo '✔ Фильтрация по гео выключена. Вы можете включить её убрав символы <b>//</b> в начале строки <b>#'.cloakedEditor("\$CLOAKING['ALLOW_GEO']").'</b> и изменив значение на 2х буквенные коды нужных стран.<br><img src="http://hide.click/gif/geo.gif" border="1"><br>';
    else echo '✔ Фильтрация по гео включена. Все страны кроме '.$CLOAKING['ALLOW_GEO'].' уйдут на вайтпейдж. Вы можете изменить список стран в строке #'.cloakedEditor("\$CLOAKING['ALLOW_GEO']").'</b><br><img src="http://hide.click/gif/geo.gif" border="1"><br>';
    echo '✔ <a target="_blank" href="?cloaking=stat">Нажмите чтобы открыть страницу статистики</a>. Сохраните её в закладках.<br><br>';
    echo 'Отлично. Вы стали мастером по настройке HideClick.<br>В дальнейшем, на серверах данного хостинга, загружайте отредактированный файл и система будет работать сразу!<br><br>';
    echo '<b><u>Остался последний шаг:</u></b><br>Если всё работает без ошибок, выключите режим настройки (DEBUG_MODE) изменив значение в строке <b>#'.cloakedEditor("\$CLOAKING['DEBUG_MODE']").'</b> на <b>off</b>.<br><img src="http://hide.click/gif/debug.gif" border="1"><br>';
    echo 'После этого скрипт начнёт работать в боевом режиме и вместо этой страницы вы увидите страницу оффера или вайтпейдж.<br><br>';
    echo '<b>Важно!<br>WHITE_PAGE ДОЛЖЕН ПОЛНОСТЬЮ СООТВЕТСТВОВАТЬ ВСЕМ ПРАВИЛАМ РЕКЛАМНОЙ СЕТИ!</b><br>Информацию о том как сделать правильный вайтпейдж можно найти у нас в телеграме: <a href="tg://resolve?domain=hideclick_official">@hideclick_official</a>.';
    die();
}
else {

}

if(empty($CLOAKING['WHITE_PAGE']) || (!strstr($CLOAKING['WHITE_PAGE'],'://') && !is_file($CLOAKING['WHITE_PAGE']))){
    echo "<html><head><meta charset=\"UTF-8\"></head><body>ERROR FILE NOT FOUND: ".$CLOAKING['WHITE_PAGE']."! \r\n<br><br>Файл не найден:".$CLOAKING['WHITE_PAGE']."!".$errorContactMessage;
    die();
}
if(empty($CLOAKING['OFFER_PAGE']) || (!strstr($CLOAKING['OFFER_PAGE'],'://') && !is_file($CLOAKING['OFFER_PAGE']))){
    echo "<html><head><meta charset=\"UTF-8\"></head><body>ERROR FILE NOT FOUND: ".$CLOAKING['OFFER_PAGE']."! \r\n<br><br>Файл не найден:".$CLOAKING['OFFER_PAGE']."!".$errorContactMessage;
    die();
}
// отсюда начинается реальная логика работы скрипта.
// dirty hack для бинома и подобно настроенных серверов, у которых все запросы идут через скрипт.
if (function_exists('header_remove')) header_remove("X-Powered-By");
@ini_set('expose_php', 'off');

if(empty($CLOAKING['HTACCESS_FIX']) && preg_match('#\.(jpg|gif|jpeg|css|gif|svg|ttf|woff|webm|ico|js)$#i',$_SERVER["REQUEST_URI"])){
    if(!stristr($CLOAKING['OFFER_PAGE'],'://')) cloakedOfferPage($CLOAKING['OFFER_PAGE'],$CLOAKING['OFFER_METHOD']);
    else cloakedWhitePage($CLOAKING['WHITE_PAGE'],$CLOAKING['WHITE_METHOD']);
}
if(sizeof(debug_backtrace ())>2) {
    echo "ERROR: INFINITE RECURSION";
    die();
}
$CLOAKINGdata = array();

if (function_exists("getallheaders")) $CLOAKINGdata = getallheaders();
foreach($_SERVER as $k=> $v){
    if (substr($k, 0, 5) == 'HTTP_') $CLOAKINGdata[$k] = $v;
}
$CLOAKINGdata['path']=$_SERVER["REQUEST_URI"];
$CLOAKINGdata['REQUEST_METHOD']=$_SERVER['REQUEST_METHOD'];
//fix for roadrunner ???
//$CLOAKINGdata['host']=$CLOAKING['DOMAIN'];//fix for roadrunner ???
//$CLOAKINGdata['path']=http_build_query ($_GET);//fix for roadrunner ???
// интегрируем плагины в основной код, иначе стата не учитывает их работу
$CLOAKING['banReason']='';
if($CLOAKING['NO_REF'] || !empty($CLOAKING['WHITE_REF'])){
    $ref='';
    foreach (array('HTTP_REFERER','Referer','referer','REFERER') as $k){
        if(!empty($CLOAKINGdata[$k])) {$ref=$_SERVER[$k];break;}
    }
    if(empty($ref)) $CLOAKING['banReason'].='noref.';
    elseif(!empty($CLOAKING['WHITE_REF']) && !preg_match("#https?://[^/]*(".$CLOAKING['WHITE_REF'].")#i",$ref)) $CLOAKING['banReason'].='blackref.';
}
if($CLOAKING['BLOCK_APPLE'] || $CLOAKING['BLOCK_ANDROID'] || $CLOAKING['BLOCK_WIN'] || $CLOAKING['BLOCK_MOBILE'] || $CLOAKING['BLOCK_DESCTOP']) {
    $ua='';
    foreach (array('HTTP_USER_AGENT','USER-AGENT','User-Agent','User-agent','user-agent') as $k){
        if(!empty($CLOAKINGdata[$k])) {$ua=$_SERVER[$k];break;}
    }
    if($CLOAKING['BLOCK_APPLE'] && stristr($ua,'Mac OS')) $CLOAKING['banReason'].='blockapple.';
    if($CLOAKING['BLOCK_ANDROID'] && stristr($ua,'Android')) $CLOAKING['banReason'].='blockandroid.';
    if($CLOAKING['BLOCK_WIN'] && stristr($ua,'Windows')) $CLOAKING['banReason'].='blockwin.';
    if($CLOAKING['BLOCK_MOBILE'] && (stristr($ua,'like Mac OS X')||stristr($ua,'mobile')||stristr($ua,'table'))) $CLOAKING['banReason'].='blockmobile.';
    if($CLOAKING['BLOCK_DESCTOP'] && !(stristr($ua,'like Mac OS X')||stristr($ua,'mobile')||stristr($ua,'table')))  $CLOAKING['banReason'].='blockdescktop.';
}
if($CLOAKING['DELAY_START']) {
    $ip='';
    foreach (array('HTTP_CF_CONNECTING_IP','CF-Connecting-IP','Cf-Connecting-Ip','cf-connecting-ip') as $k){
        if(!empty($_SERVER[$k])) $ip=$_SERVER[$k];
    }
    if(empty($ip)) {
        foreach (array('HTTP_FORWARDED', 'Forwarded', 'forwarded', 'REMOTE_ADDR') as $k) {
            if (!empty($_SERVER[$k])) $ip .= $_SERVER[$k];
        }
    }
    $ips=file('dummyCounter.txt',FILE_IGNORE_NEW_LINES);
    if(empty($ips)) {$ips=array(0=>0);file_put_contents('dummyCounter.txt',"0\n", FILE_APPEND);}
    else $ips=array_flip($ips);
    $ip=crc32($ip);
    if(!empty($ips[$ip]) && ($CLOAKING['DELAY_PERMANENT'] || sizeof($ips)<=$CLOAKING['DELAY_START'])){
        $CLOAKING['banReason'].='delaystart.';
    }
    elseif(sizeof($ips)<=$CLOAKING['DELAY_START']) {
        file_put_contents('dummyCounter.txt',$ip."\n", FILE_APPEND);
        $CLOAKING['banReason'].='delaystart.';
    }
}
// закончили интеграцию плагинов, и теперь можно подготовить данные для отправки на сервер
$CLOAKINGdata = json_encode($CLOAKINGdata);

if(!function_exists('curl_init')) $CLOAKING['STATUS'] = @file_get_contents('http://api.hideapi.xyz/basic?ip='.$_SERVER["REMOTE_ADDR"].'&port='.$_SERVER["REMOTE_PORT"].'&banReason='.$CLOAKING['banReason'].'&key='.$CLOAKING['API_SECRET_KEY'].'&sign=929319014271f1585231639&version='.$CLOAKING['VERSION'].$CLOAKING['WHITE_METHOD'].'.'.$CLOAKING['OFFER_METHOD'].'&js=false&cache='.$CLOAKING['DISABLE_CACHE'].'&geo='.preg_replace('#[^a-zA-Z,]+#',',',$CLOAKING['ALLOW_GEO']).'&paranoid='.$CLOAKING['PARANOID'].'&white='.urlencode($CLOAKING['WHITE_PAGE']).'&offer='.urlencode($CLOAKING['OFFER_PAGE']) , 'r', stream_context_create(array('ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,), 'http' => array('method' => 'POST', 'timeout' => 5, 'header'=> "Content-type: application/x-www-form-urlencoded\r\n". "Content-Length: ".strlen($CLOAKINGdata). "\r\n", 'content' => $CLOAKINGdata))));
else $CLOAKING['STATUS'] = @cloakedCurl('http://api.hideapi.xyz/basic?ip='.$_SERVER["REMOTE_ADDR"].'&port='.$_SERVER["REMOTE_PORT"].'&banReason='.$CLOAKING['banReason'].'&key='.$CLOAKING['API_SECRET_KEY'].'&sign=929319014271f1585231639&version='.$CLOAKING['VERSION'].$CLOAKING['WHITE_METHOD'].'.'.$CLOAKING['OFFER_METHOD'].'&js=false&cache='.$CLOAKING['DISABLE_CACHE'].'&geo='.preg_replace('#[^a-zA-Z,]+#',',',$CLOAKING['ALLOW_GEO']).'&paranoid='.$CLOAKING['PARANOID'].'&white='.urlencode($CLOAKING['WHITE_PAGE']).'&offer='.urlencode($CLOAKING['OFFER_PAGE']), $CLOAKINGdata);
$CLOAKING['STATUS'] = json_decode($CLOAKING['STATUS'], true);

if (empty($CLOAKING['banReason']) && !empty($CLOAKING['STATUS']) && !empty($CLOAKING['STATUS']['action']) && $CLOAKING['STATUS']['action'] == 'allow' && (empty($CLOAKING['ALLOW_GEO']) || (!empty($CLOAKING['STATUS']['geo']) && !empty($CLOAKING['ALLOW_GEO']) && stristr($CLOAKING['ALLOW_GEO'],$CLOAKING['STATUS']['geo'])))) {
    cloakedOfferPage($CLOAKING['OFFER_PAGE'],$CLOAKING['OFFER_METHOD'],$CLOAKING['UTM']);
}
else {
    cloakedWhitePage($CLOAKING['WHITE_PAGE'],$CLOAKING['WHITE_METHOD']);
}

function cloakedOfferPage($offer,$method='meta',$utm=false){
    if(substr($offer,0,8)=='https://' || substr($offer,0,7)=='http://') {
        // проброс UTM меток...
        if(!empty($_GET) &&  $utm) {
            if(strstr($offer,'?')) $offer.= '&'.http_build_query($_GET);
            else $offer.= '?'.http_build_query($_GET);
        }
        if($method=='302') {
            header("Location: ".$offer);
        }
        else if($method=='iframe') {
            echo "<html><head></head><body><iframe src='".$offer."' style='visibility:visible !important; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;' allowfullscreen='allowfullscreen' webkitallowfullscreen='webkitallowfullscreen' mozallowfullscreen='mozallowfullscreen'></iframe></body></html>";
        }
        else {
            echo '<html><head><meta http-equiv="Refresh" content="0; URL=' . $offer . '" ></head></html>';
        }
    }
    else require_once($offer);// сюда попадают реальные пользователи из нужного гео
    die();
}
function cloakedWhitePage($white,$method='curl'){
    if(substr($white,0,8)=='https://' || substr($white,0,7)=='http://') {
        if ($method == '302') {
            header("Location: ".$white);
        }
        else {
            if (!function_exists('curl_init')) $page = file_get_contents($white, 'r', stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false,))));
            else $page = cloakedCurl($white);
            $page = preg_replace('#(<head[^>]*>)#imU', '$1<base href="' . $white . '">', $page, 1);
            $page = preg_replace('#https://connect\.facebook\.net/[a-zA-Z_-]+/fbevents\.js#imU', '', $page);
            if (empty($page)) {
                header("HTTP/1.1 503 Service Unavailable", true, 503);
            }
            echo $page;
        }
    }
    else require_once($white);// сюда попадают боты и модеры
    die();
}
function cloakedCurl($url,$body='',$returnHeaders=false){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    if(!empty($body)) curl_setopt($ch, CURLOPT_POST, 1);
    if(!empty($returnHeaders)) curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$body");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 45);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $r = @curl_exec($ch);
    curl_close ($ch);
    return $r;
}
function cloakedEditor($s){
    $f=file($_SERVER["SCRIPT_FILENAME"]);
    $r=0;
    foreach ($f as $n=>$l){if(strstr($l,$s)) {$r=$n;break;}}
    return $r+1;
}
die();
?>