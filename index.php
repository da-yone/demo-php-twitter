<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Twitter検索</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css">
        <style>
            @font-face {
                font-family: 'kokoro';
                src: url(Kokoro.otf);
            }
            
            body {
                font-family: 'kokoro';
            }
            
            video {
                position: fixed;
                right: 0;
                top: -30px;
                width: 100%;
                height: auto;
                z-index: -1;
            }
            
            .container {
                background-color: rgba(255, 255, 255, 0.5);
                color: black;
                font-size: 16px;
            }
            
            .search {
                margin: 50px;
            }
                        
            .tweet {
                margin-top: 30px;
                margin-left: 20px;
                margin-right: 20px;
                padding-bottom: 30px;
                border-bottom: 1px solid grey;
            }
            
            .tweet .col-md-2 {
                text-align: center;
            }
            
            .tags {
                margin-left: 50px;
                margin-bottom: 30px;
            }
            
            .label {
                font-size: 18px;
                margin-right: 15px;
                cursor: pointer;
            }
                                    
        </style>
    </head>
    <body>
        <video src="ufo.mp4" autoplay loop></video>
        <nav class="nav navbar-inverse">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>                
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Twitter検索</a>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href=""><span>Home</span></a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="search row">
                <form action="index.php" method="GET">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                            <input type="text" name="q" class="form-control" value="アイカツ">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="button" id="search" class="btn btn-primary" value="検索">
                    </div>
                </form>
            </div>
            <div class="row tags">
                <div class="col-md-12">
                    <span class="label label-danger">阪神</span>
                    <span class="label label-primary">巨人</span>
                    <span class="label label-info">DeNA</span>
                    <span class="label label-success">中日</span>
                    <span class="label label-warning">広島</span>
                    <span class="label label-default">ヤクルト</span>
                </div>
            </div>
            <div id="tweets" class="row">
            <?php foreach($tweets->statuses as $tweet) : ?>
                <div class="row tweet">
                    <div class="col-md-2">
                        <img src="<?php echo $tweet->user->profile_image_url ?>" class="img-circle" data-toggle="tooltip" data-placement="top" title="<?php echo $tweet->user->name ?>"> 
                    </div>
                    <div class="col-md-10">
                        <?php echo $tweet->text ?>
                    </div>
                </div>
            <?php endforeach ?>
            </div>
        </div>
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            $(function(){
                // 初回のTweetを取得
                searchTweet();
                // ツールチップ
                $('[data-toggle="tooltip"]').tooltip();
                // Ajax
                $('#search').on('click', function(){
                    searchTweet();
                });
                // タグ
                $('.label').on('click', function(){
                    $('input[name=q]').val($(this).text());
                    searchTweet();
                });
            });
            
            // Ajax通信で検索結果を取得し、画面に表示
            function searchTweet() {
                    $('#tweets').hide('slow').html('');
                    $.ajax({
                        url: 'tweet.php?q=' + $('input[name=q]').val(),
                        success: function(data){
                            var json = JSON.parse(data);
                            var statuses = json.statuses;
                            for(var i = 0; i < statuses.length; i++){
                                var tweet = statuses[i].text;
                                var img = statuses[i].user.profile_image_url;
                                var name = statuses[i].user.name;

                                var el_image = $('<img>')
                                    .addClass('img-circle')
                                    .attr('data-toggle', 'tooltip')
                                    .attr('data-placement', 'top')
                                    .attr('title', name)
                                    .attr('src', img);
                                var el_col_image = $('<div>').addClass('col-md-2').append(el_image);
                                var el_col_text = $('<div>').addClass('col-md-10').html(tweet);
                                var el_row = $('<div>')
                                    .addClass('row tweet')
                                    .append(el_col_image)
                                    .append(el_col_text);
                                $('#tweets').append(el_row);
                            }
                            $('#tweets').show('slow');
                        }
                    });
            }
        </script>
    </body>
</html>
