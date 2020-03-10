<div class="enzaime-support">
    <?php

        global $post;
        // echo "<pre>";
    // print_r($tickets);
    ?>
    
   
    <div class="support__table-content">
         <a class="create_new_ticket" href="<?php echo site_url($post->post_name . '?action=create-new-ticket');?>"> Create New Ticket</a>
        <div class="support__inner-table">
            <div class="">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket) {?>
                            <tr>
                                <th scope="row"><?php echo $ticket->id; ?></th>
                                <td><?php echo $ticket->subject; ?></td>
                                <td><?php echo $ticket->createdAt; ?></td>
                                <td><?php echo $ticket->status; ?></td>
                                <td>
                                    <a href="#" class="btn view-btn">View</a>
                                    <a href="#" class="btn reply-btn">Reply</a>
                                </td>
                            </tr>
                       <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id="support-conversation-wrap">
                <h3>Subject</h3>
                <form action="" method="post">
                    <label>Message</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                    <input type="submit" name="submit" value="Send">
                </form>

                <div id="support-conversation-thread">
                    <table>
                        <tbody>
                            <tr>
                                <td>Project</td>
                                <td>WP User Frontend</td>
                            </tr>
                            <tr>
                                <td>Project Type</td>
                                <td>Plugin</td>
                            </tr>
                            <tr>
                                <td>Stie name</td>
                                <td>Happy Addons</td>
                            </tr>
                            <tr>
                                <td>Stie URL</td>
                                <td>http://localhost/happyaddons</td>
                            </tr>
                            <tr>
                                <td>Admin Email </td>
                                <td>john@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Client name </td>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <td>Client email </td>
                                <td>john@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
