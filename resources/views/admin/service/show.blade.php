@extends('layouts.admin.master')

@section('title','Show Details')

@push('css')
<style>
    h1.entry-title {
        font-size: 34px;
        padding: 0 0 10px;
        position: relative;
        -ms-word-wrap: break-word;
        word-wrap: break-word;
        margin: 15px 0 20px 0;
        font-weight: 600;
        line-height: 1.2;
    }
    .post-details p {
        margin: 0 0 10px 0;
    }
    .post-details ul {
        list-style: disk;
        padding: 0 0 0 40px;
    }
    .tag-title {
        display: block;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: -0.6px;
        color: #000;
        margin-bottom: 22px;
        width: 100%;
        margin: 15px 0 20px 0;
    }
    .top-post-inner-footer{
        display: flex;
        align-items: center;
    }
    .top-post-inner-footer > li > a{
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        -ms-border-radius: 15px;
        -o-border-radius: 15px;
        -webkit-box-shadow: 0px 16px 32px 0 rgb(0 0 0 / 6%);
        box-shadow: 0px 16px 32px 0 rgb(0 0 0 / 6%);
        padding: 8px 20px;
        font-weight: 500;
        font-size: 14px;
        line-height: 18px;
        margin-right: 8px;
        margin-bottom: 8px;
        display: inline-block;
        background: linear-gradient(90deg, rgb(253, 97, 81) 0%, rgb(255, 119, 74) 100%);
        border: none;
        color: white;
    }
    .widget-title{
        background: none;
        color: var(--qempo-heading-color);
        font-size: 16px;
        z-index: 9;
        font-weight: 600;
        padding-bottom: 20px;
        margin-bottom: 30px;
        margin-top: 0;
        position: relative;
        text-transform: uppercase;
        border-bottom: 1px solid #f1f1f1;
    }
    .widget-title:before{
        content: "//";
        color: #e6e6e6;
        margin-right: 10px;
    }
    .widget_categories ul li{
        position: relative;
    }
    .widget_categories ul li a{
        display: block;
        text-transform: capitalize;
        line-height: 26px;
        -webkit-transition: all 0.35s;
        transition: all 0.35s;
        -moz-transition: all 0.35s;
        -ms-transition: all 0.35s;
        color: #777;
        padding: 12px 0;
        font-weight: 500;
        font-size: 16px;
        text-decoration: none;
    }
    .widget_categories ul li .count{
        position: absolute;
        top: 14px;
        right: 0;
        z-index: 1;
        font-size: 14px;
        color: #777;
    }
    .comments-title {
        font-size: 22px;
        font-weight: 600;
        letter-spacing: -0.78px;
        position: relative;
        color: var(--qempo-heading-color);
        margin: 15px 0 20px 0;
    }
    #commentform {
    padding: 40px;
    border: solid 2px #f4f4f4;
    background-color: #ffffff;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    -o-border-radius: 30px;
}
#commentform .form-group {
    position: relative;
}
#commentform .form-group.comment-field:before {
    content: "\f304";
    font-weight: 900;
    top: 20px;
    -webkit-transform: translateY(0%);
    transform: translateY(0%);
}
#commentform .form-group:before {
    font-family: "Font Awesome 5 Free";
    font-weight: 400;
    font-size: 14px;
    position: absolute;
    right: 20px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    background-image: -webkit-gradient(linear, left bottom, left top, from(#fd6151), to(#ff774a)), -webkit-gradient(linear, left top, left bottom, from(#0439ab), to(#0439ab));
    background-image: linear-gradient(to top, #fd6151, #ff774a), linear-gradient(to bottom, #0439ab, #0439ab);
    color: #0439ab;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
#commentform textarea {
    padding-left: 10px;
    padding-right: 10px;
    min-height: 60px;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    -o-border-radius: 30px;
    -webkit-box-shadow: 0px 16px 32px 0 rgb(0 0 0 / 6%);
    box-shadow: 0px 16px 32px 0 rgb(0 0 0 / 6%);
    border: solid 2px #f4f4f4;
    background: #fff;
    padding: 20px 35px;
}
input#submit{
    background: linear-gradient(to right, #fd6151, #ff774a);
    font-size: 14px;
    font-weight: 700;
    padding: 10px 25px;
    line-height: 15px;
    position: relative;
    z-index: 9;
    display: inline-block;
    overflow: hidden;
    border: 0;
    -webkit-transition: all 0.35s;
    transition: all 0.35s;
    -moz-transition: all 0.35s;
    -ms-transition: all 0.35s;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    -o-border-radius: 30px;
    color: #fff;
    margin: 15px 0 20px 0;
}
.media-comment-left {
    min-width: 90px;
    float: left;
}
.media-comment-left .author-image {
    padding-top: 6px;
}
.media-comment-left .author-image img {
    width: 70px;
    height: 70px;
    overflow: hidden;
    border-radius: 50%;
}
.media-comment-body {
    padding-left: 1px;
    overflow: hidden;
    position: relative;
}
ol.comment-list .the-comment .author-meta {
    margin-bottom: 5px;
}
ol.comment-list .the-comment .author-meta .fn {
    font-size: 18px;
    font-weight: 600;
    letter-spacing: -0.54px;
    display: block;
    width: 100%;
    font-style: normal;
    color: #000;
}
ol.comment-list .the-comment .comment-info {
    position: relative;
    font-size: 14px;
}
ol.comment-list .the-comment .comment-info:before {
    content: "\f784";
    font-family: 'Line Awesome Free';
    font-weight: 900;
    margin-right: 5px;
}
ol.comment-list .the-comment .comment-info a {
    color: var(--qempo-body-color);
    font-size: 14px;
}
ol.comment-list .the-comment .comment-body {
    position: relative;
    margin-top: 10px;
}
ol.comment-list .comment-body p {
    margin: 0 0 5px 0;
}
.gav-comment-list {
    padding: 40px 0;
}
.top-post-footer {
    margin: 15px 0 20px 0;
}
</style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-eye icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('View ').$service->title }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('service.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <img src="{{ $service->getFirstMediaUrl('featured_image') ?? config('app.placeholder').'160' }}" alt="{{ $service->title }}" class="d-block w-100" />
                    <h1 class="entry-title">{{ $service->title }}</h1>
                    <div class="top-post-footer">
                        <ul class="top-post-inner-footer">
                            <li>
                                <a href="{{ url($service->preview) }}">Live Preview</a>
                            </li>
                            <li>
                                <a href="{{ url($service->order) }}">Build your website with this template/theme contact us.</a>
                            </li>
                            <li>
                                <a href="{{ url($service->envato) }}">Buy this theme/template</a>
                            </li>
                        </ul>
                    </div>
                    <div class="post-details">
                        {!! $service->long_description !!}
                    </div>

                    @if(!empty($service->serviceItems))
                    <div class="child-section">
                        <div class="row">
                            @foreach($service->serviceItems as $item)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ $item->getFirstMediaUrl('item_image') ?? config('app.placeholder').'160' }}" alt="Avatar" style="d-block width:100%">
                                        <div class="text-center">
                                            <h4><a href="{{ url($item->item_preview) }}">{{ $item->item_title }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- <div class="post-footer">
                        <div class="top-post-footer">
                            <h2 class="tag-title">Tags</h2>
                            <ul class="top-post-inner-footer">
                                @foreach($service->tags as $tag)
                                    <li>
                                        <a href="#">{{ $tag->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> -->

                    <div class="post-comment">
                        <div class="gav-comment-list clearfix">
                            <h2 class="comments-title">One thought on “{{ $service->title }}”</h2>
		 	                <ol class="comment-list">
		 			            <li class="comment byuser comment-author-one_admin bypostauthor even thread-even depth-1" id="li-comment-6">
		                            <div id="comment-6" class="the-comment media-comment">
                                        <div class="media-comment-left">
                                            <div class="author-image">
                                                <img alt="" src="{{ config('app.placeholder').'160' }}" class="avatar avatar-48 photo" height="48" width="48" loading="lazy">
                                            </div>
                                        </div>
                                        <div class="comment-box media-comment-body">  
                                            <div class="author-meta">
                                                <cite class="fn"><a href="" rel="external nofollow ugc" class="url">Shameul Zion</a></cite>
                                                <a href="">March 27, 2022</a>
                                            </span>
                                        </div>
                                        <div class="comment-body">
                                            <p>This is a awesome Template</p>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>

                        <div class="comment-form-main">
                            <div id="respond" class="comment-respond">
                                <h3 id="reply-title" class="comment-reply-title">
                                    <div class="comments-title">Add a Comment</div> 
                                </h3>
                                <form action="" method="post" id="commentform" class="comment-form">
                                    <textarea placeholder="Type your comments...." rows="5" id="comment" class="form-control" name="comment" aria-required="true"></textarea>
                                    <input name="submit" type="submit" id="submit" class="btn " value="Post Comment">
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <aside class="widget clearfix widget_categories">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h3 class="widget-title"><span>Category</span></h3>
                        <ul>
                            @foreach($service->categories as $category)
                                <li class="cat-item cat-item-52">
                                    <a href="">{{ $category->title }}</a>
                                    <span class="count">({{ $category->services->count() }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
			</aside>

            <aside class="widget clearfix widget_categories">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h3 class="widget-title"><span>Tags</span></h3>
                        <ul>
                            @foreach($service->tags as $tag)
                                <li class="cat-item cat-item-52">
                                    <a href="">{{ $tag->title }}</a>
                                    <span class="count">({{ $tag->services->count() }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>

            <aside class="widget clearfix widget_categories">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h3 class="widget-title"><span>Photo Gallery</span></h3>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($service->getMedia('gallery_image') as $key => $media)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" @if($key==0) class="active" @endif></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($service->getMedia('gallery_image') as $key => $media)
                                <div class="carousel-item @if($key==0) active @endif">
                                    <img class="d-block w-100" src="{{ $media->getUrl() ?? config('app.placeholder').'160' }}" class="d-block w-100">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>

            <aside class="widget clearfix widget_categories">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h3 class="widget-title"><span>SPONSOR ADDS</span></h3>
                        
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

@push('js')

@endpush