<div class="container-fluid">
    <?php
        global $post;
        echo "<pre>";
    print_r($tickets);
    ?>
    <a href="<?php echo site_url($post->post_name . '?action=create-new-ticket');?>"> Create New Ticket</a>
    <div class="row">
        <h2>Help Scout Ticket List</h2>
        <div class="col-md-8 offset-md-2">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>