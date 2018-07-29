
<select id="state" name="state" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
    <option value="0">Select</option>
      <?php 
      if($stateList)
      {
        foreach($stateList as $statelist)
        { ?>
            <option value="<?php echo $statelist->id; ?>"><?php echo $statelist->name; ?></option>
<?php   }
      }
    ?>
</select>
