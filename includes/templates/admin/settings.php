<div class="wrap">
    <h2>Help Scout Setup</h2>
    <p><?php _e( 'Enter Help Scout API Information below. For details on how to find this information and setting your pages/shortcodes please review the ', 'helpscout-integration' ); ?></p>

    <?php if ( ! empty( $authorized_code ) ): ?>
        <h2>Authorized</h2>
        <a href="<?php echo admin_url( 'admin.php?page=helpscout-integration&action=cancel_authorized' ); ?>">Cancel
            authorized</a>
        <?php
        exit();
    endif;
    ?>

    <?php
    if ( isset( $_POST['helpscout-submit'] ) ) {
        ?>
        <div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible">
            <p><strong>Settings saved.</strong></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
        <?php
    }
    ?>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th><?php _e( 'Application ID', 'helpscout-integration' ); ?></th>
                <td>
                    <input type="text" class="regular-text" name="helpscout_app_id" value="<?php echo $app_id; ?>">
                    <p class="description"><?php _e( 'Enter helpscout application id', 'helpscout-integration' ); ?></p>

                    <p class="description help_block">You need to create an OAuth2 application before you can proceed
                        . Create one by navigating to Your Profile &gt; My apps and click Create My App. When
                        creating your app use
                        <code><?php echo admin_url( 'admin.php?page=helpscout-integration' ); ?></code> as the redirect
                        url.</p>
                </td>

            </tr>
            <tr>
                <th><?php _e( 'App Secret', 'helpscout-integration' ); ?></th>
                <td>
                    <input type="text" class="regular-text" name="helpscout_app_secret"
                           value="<?php echo $app_secret; ?>">
                    <p class="description help_block">The app secret when creating a new OAuth2 application.</p>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="mailbox">
                        <?php _e( 'Mailbox ID', 'helpscout-integration' ); ?>
                    </label>
                </th>
                <td>
                    <input type="text" name="mailbox" id="mailbox" value="<?php echo $mailbox_id; ?>" placeholder=""
                           size="40"
                           class="text-input">

                    <p class="description help_block">When opening a mailbox within Help Scout, open the mailbox and
                        click Settings in the bottom left corner of the mailbox filters list and click in Edit Mailbox.
                        In the URL of the resulting settings screen, is your mailbox ID. Example,
                        https://secure.helpscout.net/settings/mailbox/<b>123456</b>/</p>
                </td>
            </tr>
            <?php if ( ! empty( $app_id ) && ! empty( $app_secret ) ): ?>
                <tr>
                    <td></td>
                    <td>
                        <a href="https://secure.helpscout.net/authentication/authorizeClientApplication?client_id=<?php echo $app_id; ?>&state=<?php echo
                        $app_secret;
                        ?>">Get
                            authorize</a></td>
                </tr>
            <?php endif; ?>
        </table>
        <?php
        wp_nonce_field( 'helpscout_integration_settings' );
        ?>
        <?php submit_button( 'Save Changes', 'primary', 'helpscout-submit', true, [] ); ?>
    </form>

</div><?php
