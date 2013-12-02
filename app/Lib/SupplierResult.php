<?php
    class SupplierResult {
        var $id;
        var $corporate_name;
        var $contact_name;
        var $contact_email;
        var $credit;
        var $contact_telephone;
        var $payed;
        var $debt;
        var $rating;

        function SupplierResult($id, $corporate_name, $contact_name, $contact_email, $credit, $contact_telephone, $payed, $debt, $rating)
        {
            $this->id = $id;
            $this->corporate_name = $corporate_name;
            $this->contact_name = $contact_name;
            $this->contact_email = $contact_email;
            $this->credit = $credit;
            $this->contact_telephone = $contact_telephone;
            $this->payed = $payed;
            $this->debt = $debt;
            $this->rating = $rating;
        }

    }
?>