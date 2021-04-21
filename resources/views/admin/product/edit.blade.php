@extends('layouts.admin_layout')

@section('title', 'Редактировать товар - '. $product->title)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать товар - {{ $product->title }}</h1>
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

                        <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" class="form-control" placeholder="Название товара" value="{{ old('title', $product->title) }}">
                                </div>
                                <div class="form-group">
                                    <label for="select">Категория</label>
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" @if($cat->id == $product->category_id) selected @endif>
                                                {{ $cat->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Уникальное имя</label>
                                    <input type="text"
                                           name="slug"
                                           class="form-control"
                                           value="{{ old('slug', $product->slug) }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="text" name="price" class="form-control" placeholder="Цена товара" value="{{ old('price', $product->price) }}">
                                </div>
                                <div class="form-group">
                                    <label for="new_price">Новая цена</label>
                                    <input type="text" name="new_price" class="form-control" placeholder="Новая цена" value="{{ old('new_price', $product->new_price) }}">
                                </div>
                                <div class="form-group">
                                    <label for="complect">Комплектация</label>
                                    <textarea name="complect" class="form-control">{{ old('complect', $product->complect) }}</textarea>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="in_stock" class="form-check-input" value="1"
                                           @if($product->in_stock)
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
                                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="text" name="id" class="form-control"value="{{ old('title', $product->id) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Создана:</label>
                                <input type="text" name="created" class="form-control"value="{{ old('title', $product->created_at) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Изменена:</label>
                                <input type="text" name="updated" class="form-control"value="{{ old('title', $product->updated_at) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Удалена:</label>
                                <input type="text" name="deleted" class="form-control"value="{{ old('title', $product->deleted_at) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

