<?php
    // TwitterOAuth
    require_once("twitteroauth/autoload.php");
    use Abraham\TwitterOAuth\TwitterOAuth;

    $TwitterOAuth = new TwitterOAuth(
        "5gDHiSNCbx8XDltUhOuUxQntj", // コンシューマキー
        "4tu8q9urfuQ5I1mEF3dd0qD6gVnN7naKQEqxL6FgN0UG6P570b", // コンシューマシークレット
        "14170601-KfxpM9lRs7cbs2QAVduqoONl0Vuqr6yRJGbS0FNt4", // アクセストークン 
        "8nk7u1hDa38a0d7lJLlvmyzVUBBBHF0laotAU9BrNsC5Q"  // アクセスシークレット
    );    
    // 認証が有効か+ユーザ情報取得
    $user = $TwitterOAuth->get("account/verify_credentials");
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
