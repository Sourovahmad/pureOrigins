@extends('admin.includes.app')
@section('content')


    <!-- Begin Page Content -->
    <div class="container-fluid">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                @if (is_array(session('success')))
                    <ul>
                        @foreach (session('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('success') }}
                @endif
            </div>
        @endif

        <!-- Begin Page Content -->
        <div class="container-fluid m-0 p-0">
            <div class="card mb-4 shadow">


                <form method="POST" id="createPostForm" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header py-3 bg-abasas-dark">
                        <nav class="navbar navbar-dark ">
                            <a class="navbar-brand">New Post</a>
                            <button type="submit" id="createPostSubmit" class="btn btn-success btn-lg d-none d-md-block">
                                Publish</button>

                        </nav>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-9 col-sm-12" id="formAllInput">

                                <div class="form-group col-12 ">
                                    <label for="title">Title<span style="color: red"> *</span></label>
                                    <input type="text" name="title" class="form-control" id="title" required>
                                </div>
                                <div class="form-group col-12 ">
                                    <label for="description"> Description<span style="color: red"> *</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="12"
                                        required></textarea>
                                </div>

                            </div>

                            <div class="col-md-3 col-sm-12">

                                <div class="form-group col-12">
                                    <label for="postType">Post Type<span style="color: red"> *</span></label>
                                    <select class="form-control form-control" value="" name="postType" id="postType"
                                        required>
                                        <option disabled selected value> select an option </option>'

                                        <option value="banner">Banner</option>
                                        <option value="gallery">Gallery</option>
                                    </select>
                                </div>
                                <div id='addSection'> </div>


                                <div class="form-group col-12 " id="formimageInput">
                                    <label for="image">Upload image<span style="color: red"> * &nbsp;</span><i id="InfoIcon"
                                            class="fa fa-info-circle" title='Image Resulation: 600 X 375'
                                            aria-hidden="true"></i></label><br>
                                    <input type="file" name="image" id="image" accept=" .jpg, .jpeg" required>
                                </div>
                                <div class="form-group col-12 ">

                                    <button type="submit" id="createPostSubmit"
                                        class="btn btn-success btn-lg d-block  d-md-none"> Publish</button>
                                </div>

                            </div>

                        </div>



                    </div>
                </form>
            </div>


        </div>



        <script>
            $(document).ready(function() {



                $('#postType').change(function() {

                    var postType = $('#postType').val();
                    if (postType == 'banner') {

                        var action = "{{ route('banners.store') }}";
                        $('#createPostForm').attr('action', action);

                        if ($("#formAllInput").is(":hidden")) {
                            $('#formAllInput').show();
                        }

                        var titleattr = $('#title').attr('required');
                        if (typeof titleattr == 'undefined'){
                            $('#title').attr("required", true);
                        }
                        var descriptioneattr = $('#description').attr('required');
                        if (typeof descriptioneattr == 'undefined'){
                            $('#description').attr("required", true);
                        }
                    }

                })




                $('#postType').change(function() {


                    var postType = $('#postType').val();
                    if (postType == 'gallery') {

                        var action = "{{ route('gallery.store') }}";
                        $('#createPostForm').attr('action', action);

                        $('#title').removeAttr('required')
                        $('#description').removeAttr('required')
                        $('#formAllInput').hide();


                        var gallerycategoryyhtml = '';
                        gallerycategoryyhtml += '<div class="form-group col-12"> ';
                        gallerycategoryyhtml +=
                            '    <label for="category_id">Program Category<span style="color: red"> *</span></label>';
                        gallerycategoryyhtml +=
                            '    <select class="form-control form-control" value="" name="gallery_category_id" id="category_id"';
                        gallerycategoryyhtml += '       required>';
                        gallerycategoryyhtml +=
                            '        <option disabled selected value> select a Category </option>';
                        gallerycategoryyhtml +=
                            '        @foreach ($galleryCategories as $category)';
                        gallerycategoryyhtml +=
                            '        <option value="{{ $category->id }}"> {{ $category->name }}</option>';
                        gallerycategoryyhtml += '        @endforeach';
                        gallerycategoryyhtml += '    </select>';
                        gallerycategoryyhtml +=
                            '<button type="button" id="addgalleryCategory" class="btn btn-link">Add New Category</button>';
                        gallerycategoryyhtml += '     <div  id="inputForCategory"></div>';
                        gallerycategoryyhtml += '</div>';

                        $('#addSection').html(gallerycategoryyhtml);
                    }

                    $('#addgalleryCategory').click(function() {


                        var html = '';
                        html += '<form id="categoryAddFormInput" >';
                        html += '<div class="form-group pl-4">';
                        html +=
                            '<label class="col-form-label" for="addName">Category Name<span style="color: red"> *</span></label>';
                        html += '<input type="text" name="name" class="form-control" id="addName">';
                        html += ' </div>';
                        html += '<div class="btn-group pl-4 p-1">';
                        html +=
                            '<button type="button" id="cancel-button"  class="form-control btn btn-danger btn-sm">Cancel</button>';
                        html +=
                            '<button type="button" id="submit-button"  class="form-control btn btn-success btn-sm">Submit</button>';
                        html += '  </div>';
                        html += ' </form>';

                        $('#inputForCategory').html(html);

                    });

                    // $('#postType').change(function() {

                    //     var postType = $('#postType').val()
                    //     if (postType != 'gallery'){

                    //         $('#formAllInput').show();
                    //         $('#title').attr("required", true);
                    //         $('#description').attr("required", true);

                    //     }
                    // });

                });




                $(document).on('click', "#cancel-button", function() {

                    var html = '';
                    $('#rowForCAtegory').html(html);
                });



                $(document).on('click', "#submit-button", function() {

                    var token = $('#csrfToken').val();
                    var name = $('#addName').val();

                    var postType = $('#postType').val();

                    if (postType == 'gallery') {

                        var home = "{{ route('index') }}";
                        var link = "admin/gallery-categories"
                        var action = home.trim() + '/' + link.trim();

                    }

                    $.ajax({
                        url: action,
                        method: 'POST',
                        data: {
                            '_token': token,
                            'name': name
                        },
                        success: function(categories) {
                            if (categories != 'Error') {
                                var html2 = '';

                                var len = categories.length - 1;

                                categories.forEach(function(category, item) {

                                    if (len == item) {
                                        html2 +=
                                            '   <option  selected="selected"  value="  ' +
                                            category.id + ' ">  ' + category
                                            .name +
                                            '    </option>';
                                    } else {
                                        html2 += '   <option value="  ' +
                                            category.id +
                                            ' "> ' + category.name +
                                            '</option>';
                                    }

                                });
                                $("#gallery_category_id").html(html2);
                            }





                        },
                        error: function(err) {

                            console.log(err);

                        }
                    });



                    var html = '';
                    $('#rowForCAtegory').html(html);


                });



            });

        </script>






    @endsection
