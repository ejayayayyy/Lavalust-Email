<?php 

defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Email_Model extends Model{
    public function saveEmail($fromEmail, $toEmail, $subject, $body, $attachment = null, $status = 'pending' ) {
        $insert = array(
            'senderEmail'   => $fromEmail,
            'recipientEmail' => $toEmail,
            'subject'       => $subject,
            'body'          => $body,
            'attachment'    => $attachment,
            'status'        => $status,
        );

        return $this->db->table('emails')->insert($insert);
    }

    public function updateStatus($id, $status){
        return $this->db->table('emails')
            ->where('id', $id)
            ->update(array('status' => $status));
    }
}