<!-- uses $results  -->
request id: <?php echo  $request_id ?>

<?php foreach ($results as $result): ?>
<div>
  <?php
    echo $result->contact_email;
    echo $result->contact_name;
    echo $result->contact_telephone;
    echo $result->corporate_name;
    echo $result->credit;
    echo $result->id;
    ?>
</div>

 <?php endforeach; ?>