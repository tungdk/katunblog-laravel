@extends('admin.admin_layout')
@section('title','Cập nhật danh mục')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục
            </header>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <?php if(isset($_COOKIE['msg'])){ ?>
    <div class="alert alert-warning">
        <strong>Thất bại</strong>Cập nhật không thành công
    </div>
    <?php } ?>
{{--    @foreach($category_edit as $cate)--}}
                <div class="panel-body">
                    <div class="position-center">
    <form action="admin/category/edit/{{$category_edit->id}}" method="POST" role="form" id="form_edit">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="">Tên danh mục</label>
            <input type="text" class="form-control" id="" value="{{$category_edit->title}}" placeholder="" name="title" required="required">
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea type="text" class="form-control" name="description" required="required" rows="3">{{$category_edit->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="">Vị trí hiển thị</label>
            <select id="" name="color">
                <option {!! ($category_edit->color == 1)?'selected':''!!} value="1">Màu xanh lá</option>
                <option {!! ($category_edit->color == 2)?'selected':''!!}  value="2">Màu cam</option>
                <option {!! ($category_edit->color == 3)?'selected':''!!}  value="3">Màu xanh dương</option>
                <option {!! ($category_edit->color == 4)?'selected':''!!}  value="4">Màu tím</option>
                <option {!! ($category_edit->color == 5)?'selected':''!!}  value="5">Màu đỏ</option>
            </select>
        </div>
{{--        @endforeach--}}
        <button type="submit"  name="update" class="btn btn-primary">Cập nhật</button>
        <a href="admin/category/all" type="button" class="btn btn-warning">Huỷ</a>
    </form>
                    </div>
                </div>
        </section>
    </div>

<script>
    $(document).ready(function() {
        $("#form_edit").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "title": {
                    required: true,
                    maxlength: 255
                },
                "description": {
                    required: true,
                    maxlength: 255
                },
                "color": {
                    required: true,
                    isInteger: true,
                    // between: 1,5
                },

            },
            messages: {
                "title": {
                    required: "Bắt buộc nhập tiêu đề",
                    maxlength: "Tiều đề không quá 255 ký tự"
                },
                "description": {
                    required: "Bắt buộc nhập mô tả",
                    maxlength: "Mô tả không quá 255 ký tự"
                },
                "color": {
                    required: "Bắt buộc nhập màu hiển thị",
                    isInteger: "Màu hiển thị phải là số nguyên"
                }
            }
        });
    });
</script>
@endsection
