@extends('layouts.admin_layout')

@section('title', 'Добавить категорию')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить категорию</h1>
                </div><!-- /.col -->
                {{--                <div class="col-sm-6">--}}
                {{--                    <ol class="breadcrumb float-sm-right">--}}
                {{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                {{--                        <li class="breadcrumb-item active">Dashboard v1</li>--}}
                {{--                    </ol>--}}
                {{--                </div><!-- /.col -->--}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @include('admin.includes.result_messages')

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card card-primary">

                    <form method="POST" action="{{ route('category.store', ) }}">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Название категории" value="{{ old('title', $item->title) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <textarea name="description" class="form-control" id="exampleInputEmail1">{{ old('description', $item->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Уникальное имя</label>
                                <input type="text"
                                    name="slug"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    placeholder=""
                                    value="{{ old('slug', $item->slug) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Изображение</label>
                                <input type="text" name="image" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputFile">Добавить изображения</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <div class="custom-file">--}}
{{--                                    <input type="file" class="custom-file-input" id="exampleInputFile">--}}
{{--                                    <label class="custom-file-label" for="exampleInputFile">Имя файла</label>--}}
{{--                                </div>--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">Прикрепить</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
