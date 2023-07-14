<?php echo form_open_multipart('admin/cahoc/update/' . $row['id']); ?>
<?php
$list = $this->Mmonhoc->monhoc_list();
$option_parentid = "";
foreach ($list as $r) {
	if ($r['id'] == $row['monId']) {
		$option_parentid .= "<option selected value='" . $r['id'] . "'>" . $r['name'] . "</option>";
	} else {
		$option_parentid .= "<option value='" . $r['id'] . "'>" . $r['name'] . "</option>";
	}
} 
$listHocVien = $this->Mhocvien->hocvien_list();
?>

<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/cahoc/update.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Cập nhật ca học</h1>
            <div class="breadcrumb">
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-floppy-save"></span>
                    Lưu[Cập nhật]
                </button>
                <a class="btn btn-primary btn-sm" href="admin/cahoc" role="button">
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
                                    <label>Thứ <span class="maudo">(*)</span></label>
                                    <select name="thu" class="form-control" >
                                        <option value="">[--Chọn thứ--]</option>
                                        <option value="Thứ 2" <?php if ($row['thu'] == 'Thứ 2') {
																echo 'selected';
															} ?>>Thứ 2</option>
                                        <option value="Thứ 3" <?php if ($row['thu'] == 'Thứ 3') {
																echo 'selected';
															} ?>>Thứ 3</option>
                                        <option value="Thứ 4" <?php if ($row['thu'] == 'Thứ 4') {
																echo 'selected';
															} ?>>Thứ 4</option>
                                        <option value="Thứ 5" <?php if ($row['thu'] == 'Thứ 5') {
																echo 'selected';
															} ?>>Thứ 5</option>
                                        <option value="Thứ 6" <?php if ($row['thu'] == 'Thứ 6') {
																echo 'selected';
															} ?>>Thứ 6</option>
                                        <option value="Thứ 7" <?php if ($row['thu'] == 'Thứ 7') {
																echo 'selected';
															} ?>>Thứ 7</option>
                                        <option value="Chủ Nhật" <?php if ($row['thu'] == 'Chủ Nhật') {
																echo 'selected';
															} ?>>Chủ Nhật</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian bắt đầu<span class="maudo">(*)</span></label>
                                    <input type="text" id="startTime" class="form-control" name="startTime"
                                         placeholder="Thời gian"
                                        value="<?php echo $row['startTime'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('thoigian') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian kết thúc<span class="maudo">(*)</span></label>
                                    <input type="text" id="endTime" class="form-control" name="endTime"
                                         placeholder="Thời gian" value="<?php echo $row['endTime'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('thoigian') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Tên ca học <span class="maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Tên ca học"
                                        value="<?php echo $row['name'] ?>">
                                    <div class="error" id="password_error"><?php echo form_error('name') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Môn học<span class="maudo">(*)</span></label>
                                    <select name="monId" class="form-control">
                                        <option value="">[--Chọn môn học-]</option>
                                        <option value="0">No Parent</option>
                                        <?php
										echo $option_parentid;
										?>
                                    </select>
                                    <div class="error" id="password_error"><?php echo form_error('monId') ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="">[--Chọn trạng thái--]</option>
                                        <option value="1" <?php if ($row['status'] == 1) {
																echo 'selected';
															} ?>>Đang hoạt động</option>
                                        <option value="0" <?php if ($row['status'] == 0) {
																echo 'selected';
															} ?>>Ngưng hoạt động</option>
                                    </select>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label>Học viên</label>
                                    <select class="select2" multiple name="hocvienId[]" id="hocvienId" class="form-control"
                                        style="width:100%">
                                        <?php foreach ($listHocVien as $hv): ?>
                                        <option value="<?php echo $hv['id']; ?>"
                                            <?php echo (in_array($hv['id'], array_column($hocviench, 'hocvien_id'))) ? 'selected' : ''; ?>>
                                            <?php echo $hv['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="error" id="password_error"><?php echo form_error('cahocId') ?></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </form>
    <!-- /.content -->
</div><!-- /.content-wrapper -->