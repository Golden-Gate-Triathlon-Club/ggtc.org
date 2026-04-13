<?php 
$section_background_color = get_sub_field("section_background_color"); 
$table_headline = get_sub_field("table_headline");
$table_intro_text = get_sub_field("table_intro_text");
$table_content = get_sub_field("table_content");
?>

<section id="table-<?php echo get_row_index(); ?>" class=" padding-y-100 <?php echo $section_background_color; ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if ($table_headline) : ?>
        <h2><?php echo $table_headline; ?></h2>
        <?php endif; ?>
        <?php if ($table_intro_text) : ?>
        <p><?php echo $table_intro_text; ?></p>
        <?php endif; ?>

        <?php if ($table_content) : ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-rounded table-responsive">
            <?php foreach ($table_content as $row) : ?>
            <?php if ($row['table_header']) : ?>
            <thead class="table-dark">
              <tr scope="row">
                <?php foreach ($row['table_row'] as $cell) : ?>
                <th scope="col"><?php echo $cell['table_cell']; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <?php else : ?>

            <tr scope="row">
              <?php foreach ($row['table_row'] as $cell) : ?>
              <td><?php echo $cell['table_cell']; ?></td>
              <?php endforeach; ?>
            </tr>

            <?php endif; ?>
            <?php endforeach; ?>
          </table>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>


</section>