<?php
require_once('./../DBConnection.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `queuing_start_end` where start_end_id = '{$_GET['id']}'");
        foreach($qry->fetchArray() as $k => $v){
            $$k = $v;
        }
    }
?>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Settings</h3>
    </div>

    <?php
        // Handle form submission
        if (isset($_POST['save_button'])) {
            // Get the selected start and end times from the form
            $start_time = $_POST['Start_time'];
            $end_time = $_POST['End_time'];
            $manual = isset($_POST['Manual']) ? $_POST['Manual'] : 0;
        
            $count_query = "SELECT COUNT(*) AS count FROM queuing_start_end";
            $count_result = $conn->query($count_query);
        
            if ($count_result) {
                $count_row = $count_result->fetchArray(SQLITE3_ASSOC);
                $count = $count_row['count'];
                
                if ($count == 0) {
                    // If there is no record, insert a new one
                    $insert_query = "INSERT INTO queuing_start_end (default_start_time, default_cutoff_time, manual) VALUES ('$start_time', '$end_time', '$manual')";
                    $result = $conn->query($insert_query);
                    
                    if ($result) {
                        echo "Record inserted successfully";
                    } else {
                        echo "Error inserting record: " . $conn->lastErrorMsg();
                    }
                } else {
                    // If there is a record, update it
                    $update_query = "UPDATE queuing_start_end SET default_start_time = '$start_time', default_cutoff_time = '$end_time', manual_cutoff_time = '$manual'";
                    $result = $conn->query($update_query);
                    
                    if ($result) {
                    } else {
                        echo "Error updating record: " . $conn->lastErrorMsg();
                    }
                }
            } else {
                echo "Error checking count of records: " . $conn->lastErrorMsg();
            }
        }
        
        ?>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo isset($start_end_id) ? $start_end_id : '' ?>">
            <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <center>
                            <label for="time1">DEFAULT</label><br>
                            <label for="start_time">Start:</label>
                            <select name="Start_time">
                            <?php 
        $start_time = strtotime('5:00am');
        $end_time = strtotime('6:00pm');
        $interval = 30 * 60; // 30 minutes in seconds

        $query = "SELECT default_start_time, default_cutoff_time, manual_cutoff_time FROM queuing_start_end";
        $result = $conn->query($query);
        $row = $result->fetchArray(SQLITE3_ASSOC);

        
        // check if selected value is stored in session variable
            $selected_start_time = $row['default_start_time'];
        
        
        // generate time options
        for ($i = $start_time; $i <= $end_time; $i += $interval) {
            $time = date('g:i A', $i);
            echo "<option value='$time'";
            if ($selected_start_time == $time) {
                echo ' selected';
            }
            echo ">$time</option>";
        }
    ?>
                            </select>

                            <label for="end_time">CutOff:</label>
                            <select name="End_time">
                            <?php 
                                $start_time = strtotime('5:00am');
                                $end_time = strtotime('6:00pm');
                                $interval = 30 * 60; // 30 minutes in seconds

                                $query = "SELECT default_start_time, default_cutoff_time, manual_cutoff_time FROM queuing_start_end";
                                $result = $conn->query($query);
                                $row = $result->fetchArray(SQLITE3_ASSOC);
                        
                            
                                $selected_end_time = $row['default_cutoff_time'];
                                

                                for ($i = $start_time; $i <= $end_time; $i += $interval) {
                                $time = date('g:i A', $i);
                                echo "<option value='$time'";
                                if ($selected_end_time == $time) {
                                    echo ' selected';
                                }
                                echo ">$time</option>";
                                }
                            ?>
                            </select>
                            </center>
                        </div>

                        <div class="col-md-6">
                            <center>
                            <label for="manual_toggle">Manual:</label><br>
                            <input type="hidden" name="Manual" value="0">
                            <label class="switch">
                        <?php
                        // Set the default value of the manual toggle
                        
                        
                        $query = "SELECT default_start_time, default_cutoff_time, manual_cutoff_time FROM queuing_start_end";
                        $result = $conn->query($query);
                        $row = $result->fetchArray(SQLITE3_ASSOC);
                        
                        $manual_toggle = $row['manual_cutoff_time'];
                    
                        ?>
                        <input type="checkbox" name="Manual" value="1" <?php if ($manual_toggle == 1) echo "checked"; ?>>
                        <span class="slider round"></span>
                    </label>
                            </center>
                        </div>
                        </div>
                        <div class="row justify-content-center my-2">
                        <center>
                            <button class="btn btn-primary" type="submit" name="save_button">Save</button>
                        </center>
                    </div>                                
            </div>
        </form>
    </div>
    </div>
</div>
<div>
    
<label></label>
</div>
<div class="col-md-12">
        <?php 
            $img = scandir('./../update_image'); // Assuming images are stored in the './../images' directory
            $image = isset($img[2]) ? $img[2] : null; // Check if index 2 exists, otherwise set $image to null
            if ($image):
        ?>
            <!-- Display the uploaded image -->
            <center>
                <img src="./../update_image/<?php echo $image; ?>" alt="Uploaded Image" style="height: 50vh; width: 75%;" class="bg-dark">
            </center>
        <?php 
            endif; 
        ?>
        <form action="" id="upload-form">
            <!-- Use "image" instead of "video" as the form field name -->
            <input type="hidden" name="image" value="<?php echo $image; ?>">
            <div class="row justify-content-center my-2">
                <div class="form-group col-md-4">
                    <label for="img" class="control-label">Update Image</label>
                    <!-- Set accept attribute to accept only image files -->
                    <input type="file" name="img" id="img" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <center>
                    <button class="btn btn-primary" type="submit">Update</button>
                </center>
            </div>
        </form>
    </div>
</div>

<script>
    $(function(){
        $('#upload-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
            _el.addClass('pop_msg')
            _this.find('button').attr('disabled', true)
            _this.find('button[type="submit"]').text('Updating Image...')
            $.ajax({
                url: './../Actions.php?a=update_image', // Replace with the URL for handling image uploads
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled', false)
                    _this.find('button[type="submit"]').text('Update')
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        _el.addClass('alert alert-success')
                        location.reload()
                        if ("<?php echo isset($department_id) ?>" != 1)
                            _this.get(0).reset();
                    } else {
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)
                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled', false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>