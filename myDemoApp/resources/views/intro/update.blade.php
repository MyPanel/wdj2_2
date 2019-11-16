@extends('layouts.app')
@section('style')
<style>
    textarea {
        -moz-appearance: none;
		-webkit-appearance: none;
		-o-appearance: none;
		-ms-appearance: none;
		appearance: none;
		background: white;
		color: #555555;
		border: none;
		display: block;
		outline: 0;
		padding: 1em 1em;
		text-decoration: none;
		width: 100%;
		border-radius: 6px;
		color: #555555;
		font-family: 'Raleway', sans-serif;
		font-size: 12pt;
		font-weight: 300;
		line-height: 1.65em;
        min-height: 14em;
	}

    .wrapper.style1 {
		padding-top: 4em;
		padding-bottom: 2em;
	}
    .wrapper.style1 {
    padding-top: 10em;
    padding-bottom: 2em;
    background: url(../images/bg.jpg) no-repeat center top;
    background-size: cover;
    background-attachment: fixed;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    }

    .wrapper.style2 {
        padding: 6em 0;
        background: #ffa366;
        color: white;
    }
    #footer {
		text-align: center;
	}
	footer > :last-child {
		margin-bottom: 0;
	}
		#footer .major h2,
		#footer .major .byline {
			color: #FFF !important;
		}
        footer.major {
		padding-top: 3em;
	}
    li {
        list-style-type: none;
    }
    input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    }
    #btn_group button{ border: 1px solid skyblue; background-color: rgba(0,0,0,0); color: skyblue; padding: 5px; } 
    #btn_group button:hover{ color:white; background-color: skyblue; }

</style>
@endsection
@section('content')
<div id="footer" class="wrapper style2">
        <div class="container">
            <section>
                <header class="major">
                    <h2>Mauris vulputate dolor</h2>
                    <span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
                </header>
                <form method="post" action="#">
                    <div class="row half">
                        <div class="12u">
                            <input class="text" type="text" name="name" id="name" value="{{Auth::user()->name}}" />
                        </div>
                    </div>
                    <div class="row half">
                        <div class="12u">
                            <textarea name="comment" id="comment" placeholder="comment" cols=100">{{Auth::user()->email}}</textarea>
                        </div>
                    </div>
                    <div class="row half">
                        <div class="12u">
                            <ul class="actions">
                                <li type="">
                                    <input type="submit" value="Send Message" id="btn_group" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection