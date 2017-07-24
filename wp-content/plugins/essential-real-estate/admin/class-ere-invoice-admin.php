<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if (!class_exists('ERE_Invoice_Admin')) {
    /**
     * Class ERE_Invoice_Admin
     */
    class ERE_Invoice_Admin
    {
        /**
         * Register custom columns
         * @param $columns
         * @return array
         */
        public function register_custom_column_titles($columns)
        {
            $columns['cb'] = "<input type=\"checkbox\" />";
            $columns['title'] = esc_html__('Invoice', 'essential-real-estate');
            $columns['invoice_payment_method'] = esc_html__('Payment Method', 'essential-real-estate');
            $columns['invoice_payment_type'] =esc_html__('Payment Type', 'essential-real-estate');
            $columns['invoice_price'] =  esc_html__('Money', 'essential-real-estate');
            $columns['invoice_user_id'] =esc_html__('Buyer', 'essential-real-estate');
            $columns['invoice_status'] = esc_html__('Status', 'essential-real-estate');
            $columns['date'] = esc_html__('Date', 'essential-real-estate');
            return $columns;
        }

        /**
         * sortable_columns
         * @param $columns
         * @return mixed
         */
        public function sortable_columns($columns)
        {
            $columns['title'] = 'title';
            $columns['invoice_payment_method'] = 'invoice_payment_method';
            $columns['invoice_payment_type'] = 'invoice_payment_type';
            $columns['invoice_price'] = 'invoice_price';
            $columns['invoice_user_id'] = 'invoice_user_id';
            $columns['invoice_status'] = 'invoice_status';
            $columns['date'] = 'date';
            return $columns;
        }

        /**
         * Display custom column for invoice
         * @param $column
         */
        public function display_custom_column($column)
        {
            global $post;
            $invoice_meta = get_post_meta($post->ID, ERE_METABOX_PREFIX . 'invoice_meta', true);
            switch ($column) {
                case 'invoice_payment_method':
                    echo ERE_Invoice::get_invoice_payment_method($invoice_meta['invoice_payment_method']);
                    break;
                case 'invoice_payment_type':
                    echo ERE_Invoice::get_invoice_payment_type($invoice_meta['invoice_payment_type']);
                    break;
                case 'invoice_price':
                    echo esc_attr($invoice_meta['invoice_item_price']);
                    break;
                case 'invoice_user_id':
                    $user_info = get_userdata($invoice_meta['invoice_user_id']);
                    if($user_info)
                    {
                        echo esc_attr($user_info->display_name);
                    }
                    break;
                case 'invoice_status':
                    $invoice_status = get_post_meta($post->ID, ERE_METABOX_PREFIX . 'invoice_payment_status', true);
                    if ($invoice_status == 0) {
                        echo '<span class="ere-label-red">' . __('Not Paid', 'essential-real-estate') . '</span>';
                    } else {
                        echo '<span class="ere-label-blue">' . __('Paid', 'essential-real-estate') . '</span>';
                    }
                    break;
            }
        }

        /**
         * Get invoices by property
         * @param $property_id
         */
        public function get_invoices_by_property($property_id)
        {
            $args = array(
                'post_type' => 'invoice',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => ERE_METABOX_PREFIX . 'invoice_item_id',
                        'value' => $property_id,
                        'compare' => '=',
                        'type' => 'NUMERIC'
                    ),
                    array(
                        'key' => ERE_METABOX_PREFIX . 'invoice_payment_type',
                        'value' => 'Package',
                        'compare' => '!=',
                        'type' => 'CHAR'
                    )
                )
            );
            $invoices = get_posts($args);
            if (!$invoices) {
                esc_html_e('No invoice', 'essential-real-estate');
            } else {
                foreach ($invoices as $invoice):
                    if ($invoice->ID > 0):
                        ?>
                        <a title="<?php esc_html_e('Click to view invoice', 'essential-real-estate') ?>"
                           href="<?php echo get_edit_post_link($invoice->ID) ?>"><?php echo $invoice->ID; ?></a>
                        <?php
                    endif;
                endforeach;
            }
        }

        /**
         * Modify invoice slug
         * @param $existing_slug
         * @return string
         */
        public function modify_invoice_slug($existing_slug)
        {
            $invoice_url_slug = ere_get_option('invoice_url_slug');
            if ($invoice_url_slug) {
                return $invoice_url_slug;
            }
            return $existing_slug;
        }
        /**
         * filter_restrict_manage_invoice
         */
        public function filter_restrict_manage_invoice() {
            global $typenow;
            $post_type = 'invoice';

            if ($typenow == $post_type){
                //Invoice Status
                $values=array(
                    'not_paid'=>esc_html__('Not Paid','essential-real-estate'),
                    'paid'=>esc_html__('Paid','essential-real-estate'),
                );
                ?>
                <select name="invoice_status">
                    <option value=""><?php _e('All Status', 'essential-real-estate'); ?></option>
                    <?php $current_v = isset($_GET['invoice_status'])? $_GET['invoice_status']:'';
                    foreach ($values as $value => $label) {
                        printf
                        (
                            '<option value="%s"%s>%s</option>',
                            $value,
                            $value == $current_v? ' selected="selected"':'',
                            $label
                        );
                    }
                    ?>
                </select>
                <?php
                //Payment method
                $values=array(
                    'Paypal'=>esc_html__('Paypal','essential-real-estate'),
                    'Stripe'=>esc_html__('Stripe','essential-real-estate'),
                    'Wire_Transfer'=>esc_html__('Wire Transfer','essential-real-estate'),
                    'Free_Package'=>esc_html__('Free Package','essential-real-estate'),
                );
                ?>
                <select name="invoice_payment_method">
                    <option value=""><?php _e('All Payment Methods', 'essential-real-estate'); ?></option>
                    <?php $current_v = isset($_GET['invoice_payment_method'])? $_GET['invoice_payment_method']:'';
                    foreach ($values as $value => $label) {
                        printf
                        (
                            '<option value="%s"%s>%s</option>',
                            $value,
                            $value == $current_v? ' selected="selected"':'',
                            $label
                        );
                    }
                    ?>
                </select>
                <?php
                //Payment type
                $values=array(
                    'Package'=>esc_html__('Package','essential-real-estate'),
                    'Listing'=>esc_html__('Listing','essential-real-estate'),
                    'Upgrade_To_Featured'=>esc_html__('Upgrade to Featured','essential-real-estate'),
                    'Listing_With_Featured'=>esc_html__('Listing with Featured','essential-real-estate'),
                );
                ?>
                <select name="invoice_payment_type">
                    <option value=""><?php _e('All Payment Types', 'essential-real-estate'); ?></option>
                    <?php $current_v = isset($_GET['invoice_payment_type'])? $_GET['invoice_payment_type']:'';
                    foreach ($values as $value => $label) {
                        printf
                        (
                            '<option value="%s"%s>%s</option>',
                            $value,
                            $value == $current_v? ' selected="selected"':'',
                            $label
                        );
                    }
                    ?>
                </select>
                <input type="text" placeholder="<?php esc_html_e('Buyer','essential-real-estate');?>" name="invoice_user" value="<?php echo (isset($_GET['invoice_user'])? $_GET['invoice_user']:'');?>">
            <?php }
        }

        /**
         * invoice_filter
         * @param $query
         */
        public function invoice_filter($query) {
            global $pagenow;
            $post_type = 'invoice';
            $q_vars    = &$query->query_vars;$filter_arr=array();
            if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type)
            {
                if(isset($_GET['invoice_user']) && $_GET['invoice_user'] != '')
                {
                    $user = get_user_by('login',$_GET['invoice_user']);
                    $user_id=-1;
                    if($user)
                    {
                        $user_id=$user->ID;
                    }
                    $filter_arr[] = array(
                        'key' =>ERE_METABOX_PREFIX. 'invoice_user_id',
                        'value' =>  $user_id,
                        'compare' => 'IN',
                    );
                }
                if(isset($_GET['invoice_status']) && $_GET['invoice_status'] != '')
                {
                    $invoice_status=0;
                    if($_GET['invoice_status']=='paid')
                    {
                        $invoice_status=1;
                    }
                    $filter_arr[] = array(
                        'key' =>ERE_METABOX_PREFIX. 'invoice_payment_status',
                        'value' => $invoice_status,
                        'compare' => '=',
                    );
                }
                if(isset($_GET['invoice_payment_method']) && $_GET['invoice_payment_method'] != '') {
                    $filter_arr[] = array(
                        'key' => ERE_METABOX_PREFIX . 'invoice_payment_method',
                        'value' => $_GET['invoice_payment_method'],
                        'compare' => '=',
                    );
                }
                if(isset($_GET['invoice_payment_type']) && $_GET['invoice_payment_type'] != '') {
                    $filter_arr[] = array(
                        'key' => ERE_METABOX_PREFIX . 'invoice_payment_type',
                        'value' => $_GET['invoice_payment_type'],
                        'compare' => '=',
                    );
                }
                if (! empty($filter_arr) ) {
                    $q_vars['meta_query'] = $filter_arr;
                }
            }
        }
    }
}