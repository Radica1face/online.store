@extends('layouts.admin_layout')

@section('title', 'Товары')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товары</h1>
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
    @include('admin.includes.result_messages')

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 1%">
                                        ID
                                    </th>
                                    <th style="width: 20%">
                                        Название
                                    </th>
                                    <th style="width: 20%">
                                        Категория
                                    </th>
                                    <th style="width: 20%">
                                        Цена
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        Наличие
                                    </th>
                                    <th style="width: 30%">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->title }}
                                    </td>
                                    <td>
                                        @if(isset($item->category->title))
                                        {{ $item->category->title }}
                                        @else
                                            Нет категории
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->new_price)
                                        <div>{{ $item->new_price }}</div>
                                        <small style="text-decoration: line-through;">
                                            {{ $item->price }}
                                        </small>
                                        @else
                                            <div>{{ $item->price }}</div>
                                        @endif
                                    </td>
                                    <td class="project-state">
                                        @if($item->in_stock)
                                        <span class="badge badge-success">В наличии</span>
                                        @else
                                        <span class="badge badge-danger">Нет в наличии</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('product.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('product.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                @if($products->total() > $products->count())

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            {{ $products->links() }}
                        </div>
                    </div>
                @endif

            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

