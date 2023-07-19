<?php echo form_open_multipart('admin/nhanvien/insert'); ?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/nhanvien/insert.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Thêm nhân viên mới</h1>
            <div class="breadcrumb">
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-floppy-save"></span>
                    Lưu[Thêm]
                </button>
                <a class="btn btn-primary btn-sm" href="admin/nhanvien" role="button">
                    <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
                </a>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box" id="view">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên nhân viên <span class="maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="name" style="width:70%"
                                        placeholder="Tên nhân viên">
                                    <div class="error" id="password_error"><?php echo form_error('name') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Chọn ca</label>
                                    <select class="select2" multiple name="calamid[]" id="calamid" class="form-control"
                                        style="width:70%">
                                        <option value="">Chọn ca</option>
                                        <option value="1">Sáng</option>
                                        <option value="2">Chiều</option>
                                        <option value="3">Tối</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi" style="width:70%"
                                        placeholder="Địa chỉ">
                                    <div class="error" id="password_error"><?php echo form_error('diachi') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" style="width:70%"
                                        placeholder="Số điện thoại">
                                    <div class="error" id="password_error"><?php echo form_error('phone') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Năm sinh </label>
                                    <input type="text" class="form-control" name="ngaysinh" style="width:70%"
                                        placeholder="Năm sinh">
                                    <div class="error" id="password_error"><?php echo form_error('ngaysinh') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control" style="width:70%">
                                        <option value="">[--Chọn trạng thái--]</option>
                                        <option value="1" selected>Hoạt động</option>
                                        <option value="0">Chưa hoạt động</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <select name="gioitinh" class="form-control" style="width:70%">
                                        <option value="">[--Chọn giới tính--]</option>
                                        <option value="1" selected>Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div><!-- /.box -->
                </div>
        </section>
    </form>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

</script>

<script type="text/javascript">
</script>