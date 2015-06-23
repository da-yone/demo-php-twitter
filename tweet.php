<?php
    // TwitterOAuth
    require_once("twitteroauth/autoload.php");
    use Abraham\TwitterOAuth\TwitterOAuth;

    $TwitterOAuth = new TwitterOAuth(
        "Consumer Key", // コンシューマキー
        "Consumer Secret", // コンシューマシークレット
        "Access Token", // アクセストークン 
        "Access Secret"  // アクセスシークレット
    );    
    // 検索クエリ
    $q = "アイカツ";
    if (isset($_GET["q"])) $q = $_GET["q"];
    $query = [
        "q" => $q, // 検索キーワード
        "count" => 50, // 取得数
        "result_type" => "recent",
        "lang" => "ja" // 言語
    ];
    // 検索結果取得
    $tweets = $TwitterOAuth->get("search/tweets", $query);

    echo json_encode($tweets);
?>
