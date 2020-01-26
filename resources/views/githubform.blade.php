<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            img {
                height: 50px;
                width: 50px;
            }
        </style>
    </head>
    <body>


            <div class="container">
                <div>
                    <h1>Github api</h1>
                    <form action="{{route('getUser')}}" method="post">
                        @csrf
                        Username: <input type="text" name="username">
                        <input type="submit" name="submit">
                    </form>
                </div>
                <div class="links">
                    @if(isset($user))
                        <img src="{{$user['avatar']}}">
                        <a href="#">{{$user['name']}}</a>
                        <a href="#">Followers: {{$user['followers']}}</a>
                        <a href="#">Following: {{$user['following']}}</a>
                        <a href="#">Repositories: {{$user['repositories']}}</a>
                    @endif
                </div>

                @if(isset($arrRepos))
                    @foreach($arrRepos as $repo)
                        <div class="card" style="width: 18rem; display: inline-block;">
                            @if(isset($imgs))
                                @foreach($imgs as $img)
                                    @if($img['repo'] == $repo['name'])
                                        <img style="width: 100%; height: 100px;" src="{{$img['url']}}">
                                    @endif
                                @endforeach
                            @endif
                            <form action="{{route('getUser')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('POST')
                                <input type="file" name="image">
                                <input type="hidden" name="username" value="{{$user['username']}}">
                                <input type="hidden" name="reponame" value="{{$repo['name']}}">
                                <input type="submit" name="submit" value="submit">
                            </form>                       
                          <img src="..." class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">{{$repo['name']}}</h5>
                            <p class="card-text">Description: {{$repo['description']}}</p>
                            <p class="card-text">Last commit date: {{$repo['pushed_at']}}</p>
                            <p class="card-text">Collaborators:</p>
                            <ul>
                                @if(isset($repo['collaborators']))
                                    @foreach($repo['collaborators'] as $collab)
                                        <li><img style="height: 20px; width: 20px;" src="{{$collab['avatar_url']}}">{{$collab['login']}} - Commits: {{$collab['contributions']}}</li>
                                    @endforeach
                                @endif
                            </ul>
                          </div>
                        </div>
                    @endforeach
                @endif
            </div>
    </body>
</html>
