<?php
    class SupplierResult {
        var $id;
        var $corporate_name;
        var $moral_rfc;
        var $contact_name;
        var $contact_email;
        var $contact_telephone;
        var $rating;
        var $accepted_quotes;
        var $rejected_quotes;
        var $deleted;
        var $payed;
        var $debt;
        var $credit;
        var $rejected_price;
        var $rejected_existance;
        var $rejected_response;
        var $rejected_deliver;

        function SupplierResult($id,$corporate_name,$moral_rfc,$contact_name,$contact_email,$contact_telephone,$rating,$accepted_quotes,$rejected_quotes,$deleted,$payed,$debt,$credit,$rejected_price,$rejected_existance,$rejected_response,$rejected_deliver)
        {
            $this->id = $id;
            $this->corporate_name = $corporate_name;
            $this->moral_rfc = $moral_rfc;
            $this->contact_name = $contact_name;
            $this->contact_email = $contact_email;
            $this->contact_telephone = $contact_telephone;
            $this->rating = $rating;
            $this->accepted_quotes = $accepted_quotes;
            $this->rejected_quotes = $rejected_quotes;
            $this->deleted = $deleted;
            $this->payed = $payed;
            $this->debt = $debt;
            $this->credit = $credit;
            $this->rejected_price = $rejected_price;
            $this->rejected_existance = $rejected_existance;
            $this->rejected_response = $rejected_response;
            $this->rejected_deliver = $rejected_deliver;
        }

    }
?>