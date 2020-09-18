
<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="admin/category/add" method="POST" role="form" id="form_add">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" id="title" placeholder="" name="title"
                               required="required">
                        {{--            <p class="error-input" id="err-title">Bạn chưa nhập tên danh mục</p>--}}
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control" id="description" placeholder="" name="description"
                        >
                        {{--            <p class="error-input" id="err-description">Bạn chưa nhập mô tả danh mục</p>--}}
                    </div>
                    <div class="form-group">
                        <label for="">Màu hiển thị</label>
                        <select id="color" name="color">
                            <option value="1">Màu Xanh lá</option>
                            <option value="2">Màu cam</option>
                            <option value="3">Màu xanh dương</option>
                            <option value="4">Màu tím</option>
                            <option value="5">Màu đỏ</option>
                        </select>
                    </div>
{{--                    <button type="submit" class="btn btn-primary" id="btn-submit">Thêm</button>--}}
                    {{--        <a href="categories.php" type="submit"  class="btn btn-warning" >Huỷ</a>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="add_submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
