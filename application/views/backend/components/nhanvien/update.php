<?php echo form_open_multipart('admin/nhanvien/update/'.$row['id']); ?>

<?php
$listCa = [
    [
        "id" => 1,
        "name" => "Ca sáng"
    ],
    [
        "id" => 2,
        "name" => "Ca chiều"
    ],
    [
        "id" => 3,
        "name" => "Ca tối"
    ],
];
$cahoc = $row['calamid'];
$selectedIds = json_decode($cahoc);
?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/nhanvien/update.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Update nhân viên</h1>
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
                                        placeholder="Tên nhân viên" value="<?php echo $row['name'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('name') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Chọn ca</label>
                                    <select class="select2" multiple name="calamid[]" id="calamid" class="form-control"
                                        style="width:70%">
                                        <?php foreach ($listCa as $ca): ?>
                                        <option value="<?php echo $ca['id']; ?>"
                                            <?php echo (in_array($ca['id'], $selectedIds)) ? 'selected' : ''; ?>>
                                            <?php echo $ca['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi" style="width:70%"
                                        placeholder="Địa chỉ" value="<?php echo $row['diachi'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('diachi') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" style="width:70%"
                                        placeholder="Số điện thoại" value="<?php echo $row['phone'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('phone') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Năm sinh </label>
                                    <input type="text" class="form-control" name="ngaysinh" style="width:70%"
                                        placeholder="Năm sinh" value="<?php echo $row['ngaysinh'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('ngaysinh') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control" style="width:70%">
                                        <option value="1" <?php if ($row['status'] == 1) {
																echo 'selected';
															} ?>>Hoạt động</option>
                                        <option value="0" <?php if ($row['status'] == 0) {
																echo 'selected';
															} ?>>Ngừng hoạt động</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <select name="gioitinh" class="form-control" style="width:70%">
                                        <option value="1" <?php if ($row['status'] == 1) {
																echo 'selected';
															} ?>>Nam</option>
                                        <option value="0" <?php if ($row['status'] == 0) {
																echo 'selected';
															} ?>>Nữ</option>
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