<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Blog Details</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.blogs') }}"> Blog Details</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="blog-single">
                    <div class="blog-box blog-details"><img class="img-fluid w-100"
                            src="{{ asset('storage/' . $blog->image) }}" alt="blog-main">
                        <div class="blog-details">
                            <ul class="blog-social">
                                <li>{{ date('d', strtotime($blog->created_at)) }}
                                    {{ date('F', strtotime($blog->created_at)) }}
                                    {{ date('Y', strtotime($blog->created_at)) }} </li>
                                <li><i class="icofont icofont-user"></i> <span> {{ $blog->users->name }} </span></li>
                                <li><i class="icofont icofont-thumbs-up"></i>02<span>Hits</span></li>
                                <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                            </ul>
                            <h4>
                                {{ $blog->title }}
                            </h4>
                            <div class="single-blog-content-top">
                                <h6>{{ $blog->short_description }}</h6>
                            </div>
                            <div class="single-blog-content-top">
                                <p>{!! $blog->body !!}</p>
                            </div>
                        </div>
                    </div>
                    <section class="comment-box">
                        <h4>Comment</h4>
                        <hr>
                        <ul>
                            <li>
                                <div class="media align-self-center"><img class="align-self-center"
                                        src="{{ asset('assets/images/blog/comment.jpg') }}"
                                        alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="comment-social float-start float-md-end">
                                                    <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                    <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the
                                            majority have suffered alteration in some form, by injected humour, or
                                            randomised words which don't look even slightly believable. If you are going
                                            to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                                            embarrassing hidden in the middle of text.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <ul>
                                    <li>
                                        <div class="media"><img class="align-self-center"
                                                src="{{ asset('assets/images/blog/9.jpg') }}"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                                    </div>
                                                </div>
                                                <p>There are many variations of passages of Lorem Ipsum available, but
                                                    the majority have suffered alteration in some form, by injected
                                                    humour, or randomised words which don't look even slightly
                                                    believable. If you are going to use a passage of Lorem Ipsum, you
                                                    need to be sure there isn't anything embarrassing hidden in the
                                                    middle of text.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="media"><img class="align-self-center"
                                        src="{{ asset('assets/images/blog/9.jpg') }}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="comment-social float-start float-md-end">
                                                    <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                    <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the
                                            majority have suffered alteration in some form, by injected humour, or
                                            randomised words which don't look even slightly believable. If you are going
                                            to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                                            embarrassing hidden in the middle of text.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><img class="align-self-center"
                                        src="{{ asset('assets/images/blog/9.jpg') }}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="comment-social float-start float-md-end">
                                                    <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                    <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the
                                            majority have suffered alteration in some form, by injected humour, or
                                            randomised words which don't look even slightly believable. If you are going
                                            to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                                            embarrassing hidden in the middle of text.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media"><img class="align-self-center"
                                        src="{{ asset('assets/images/blog/9.jpg') }}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="mt-0">Jolio Mark<span> ( Designer )</span></h6>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="comment-social float-start float-md-end">
                                                    <li><i class="icofont icofont-thumbs-up"></i>02 Hits</li>
                                                    <li><i class="icofont icofont-ui-chat"></i>598 Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the
                                            majority have suffered alteration in some form, by injected humour, or
                                            randomised words which don't look even slightly believable. If you are going
                                            to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                                            embarrassing hidden in the middle of text.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
