<table>
    <tr>
        <td class="myco">
            <img src="<?php echo FCPATH . 'userfiles/company/' . $this->config->item('logo') ?>" style="max-width:350px;max-height:260px;margin-left:40px">
        </td>
        <td class="mywn descr">
            <h2 style="color: #283890;"><?php echo $this->config->item('ctitle'); ?></h2><br>
            <p style="color: #283890;"><?php echo
            $this->config->item('address') . ' ' . $this->config->item('city') . ', ' . $this->config->item('region') . '<br>' . $this->config->item('country') . ' -  ' . $this->config->item('postbox') . '<br><br>' . $this->lang->line('Phone') . ': ' . $this->config->item('phone') . '<br> ' . $this->lang->line('Email') . ': ' . $this->config->item('email');
            if ($this->config->item('taxno')) echo '<br>' . $this->lang->line('Tax') . ' ID: ' . $this->config->item('taxno');
            ?></p>
        </td>
        <td style="width: 250px;">
        </td>
    </tr>
</table><br>