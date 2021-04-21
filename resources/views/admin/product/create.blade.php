@extends('layouts.admin_layout')

@section('title', 'Добавить категорию')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить товар</h1>
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

                <form method="POST" action="{{ route('product.store', ) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" class="form-control" placeholder="Название товара" value="{{ old('title', $item->title) }}">
                        </div>
                        <div class="form-group">
                            <label for="select">Категория</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Уникальное имя</label>
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   value="{{ old('slug', $item->slug) }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description" class="form-control">{{ old('description', $item->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input type="text" name="price" class="form-control" placeholder="Цена товара" value="{{ old('price', $item->price) }}">
                        </div>
                        <div class="form-group">
                            <label for="complect">Комплектация</label>
                            <textarea name="complect" class="form-control">{{ old('complect', $item->complect) }}</textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="in_stock" class="form-check-input" value="1"
                                   @if($item->in_stock)
                                   checked="checked"
                                @endif>
                            <label for="in_stock">Наличие</label>
                        </div>
                        <div class="form-group">
                            <label for="image">Зугрузить изображение</label>
                            <input type="file" name="image" class="form-control-file">
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
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
