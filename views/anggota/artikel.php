<?php echo $data['header'];?>
    <!-- Container -->
    <div id="container">
      <?php if($data['successMessage']){?>
      <!-- Message OK -->
      <div id="successMessage" class="msg msg-ok">
        <p><strong>Your file was uploaded succesifully!</strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message OK -->
      <?php } ?>
      <?php if($data['errorMessage']){?>
      <!-- Message Error -->
      <div id="errorMessage" class="msg msg-error">
        <p><strong>You must select a file to upload first!</strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message Error -->
      <?php } ?>
      <div class="row">
        <div id="main" class="col-md-10 col-sm-10">
          <?php echo $data['module_main'];?>
        </div>
        <div class="col-md-2">
          <?php echo $data['module_right'];?>
        </div>
      </div>
    </div>
    <!-- End Container -->
<?php echo $data['footer'];?>
