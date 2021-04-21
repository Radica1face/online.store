@extends('layouts.admin_layout')

@section('title', 'Редактировать категорию - '. $category->title)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать категорию - {{ $category->title }}</h1>
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
                <div class="col-lg-7">
                    <div class="card card-primary">

                        <form method="POST" action="{{ route('category.update', $category->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="exampleInputEmail1" placeholder="Название категории">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Описание</label>
                                    <textarea name="description" class="form-control" id="exampleInputEmail1">{{ $category->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Уникальное имя</label>
                                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" id="exampleInputEmail1" placeholder="Описание категории">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Изображение</label>
                                    <input type="text" name="image" value="{{ $category->image }}" class="form-control" id="exampleInputEmail1" placeholder="Описание категории">
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="exampleInputFile">Добавить изображения</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="custom-file">--}}
{{--                                            <input type="file" class="custom-file-input" id="exampleInputFile">--}}
{{--                                            <label class="custom-file-label" for="exampleInputFile">Имя файла</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="input-group-append">--}}
{{--                                            <span class="input-group-text">Прикрепить</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="text" name="id" class="form-control"value="{{ old('title', $category->id) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Создана:</label>
                                <input type="text" name="created" class="form-control"value="{{ old('title', $category->created_at) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Изменена:</label>
                                <input type="text" name="updated" class="form-control"value="{{ old('title', $category->updated_at) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Удалена:</label>
                                <input type="text" name="deleted" class="form-control"value="{{ old('title', $category->deleted_at) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

