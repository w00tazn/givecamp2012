<?php /* Template Name: test form */ ?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="col2">
<header class="entry-header"><h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wplook' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1></header>
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
<div class="entry-content"><?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php elseif ( is_single() ): ?>	
				<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wplook' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'wplook' ) . '</span>', 'after' => '</div>' ) ); ?>
		<!-- .entry-content -->
		
		<div class="clear"></div>	
			<div class="entry-utility">
				<div class="category"><b><?php _e('Category:', 'wplook'); ?></b> <?php the_category(', ') ?><div class="end"></div></div>
				<?php if ( get_the_tag_list( '', ', ' ) ) { ?><div class="tag"> <b><?php _e('Tag:', 'wplook'); ?></b> <?php echo get_the_tag_list('',', ',''); ?>
					<div class="end"></div></div>
				<?php } ?>
			</div><div class="clear"></div></div>
		<?php else : ?>	
		<div class="entry-content">
			

<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: Please add the following <FORM> element to your page.             -->
<!--  ----------------------------------------------------------------------  -->
<img src="/wp-content/themes/commit/images/get-involved-hands.png" alt="" />
<div class="get-involved-intro">
	Together we can unlock the potential of our children and our community. Join us today and help uphold our promise to the kids of Dallas County.
</div>
<p class="get-involved-fine">The information provided here will not be shared and will be used strictly to better support your efforts.</p>

<form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" class="get-involved-form">
<input type="hidden" name="oid" value="00Dd0000000ccvw" /> <input type="hidden" name="retURL" value="http://commit2dallas.com/thank-you-get-involved" /><!--  ----------------------------------------------------------------------  -->
<!--  NOTE: These fields are optional debugging elements. Please uncomment    -->
<!--  these lines if you wish to test in debug mode.                          -->
<!--
<input type="hidden" name="debug" value=1>                              -->
<!--
<input type="hidden" name="debugEmail"                                  --> <!--  value="andres.ramos@commit2dallas.org">                                 -->
<!--  ----------------------------------------------------------------------  -->
<div class="get-involved-row">
<label for="first_name">First Name:*</label>
<input id="first_name" type="text" name="first_name" size="30" maxlength="40" />
</div>
<div class="get-involved-row">
<label for="last_name">Last Name:*</label>
<input id="last_name" type="text" name="last_name" size="30" maxlength="80" />
</div>
<div class="get-involved-row">
<label for="email">Email:*</label>
<input id="email" type="text" name="email" size="30" maxlength="80" />
</div>
<div class="get-involved-row">
<label for="title">Title:</label>
<input id="title" type="text" name="title" size="30" maxlength="40" />
</div>
<div class="get-involved-row">
<label for="company">Organization:</label>
<input id="company" type="text" name="company" size="30" maxlength="40" />
</div>
<div class="get-involved-row">
<label for="00Nd000000557St" class="long-label">Organization Type:</label>
<select id="00Nd000000557St" title="Organization Type" name="00Nd000000557St"> <option value="">--None--</option> <option value="Business">Business</option> <option value="Foundation">Foundation</option> <option value="Government">Government</option> <option value="Nonprofit">Nonprofit</option> <option value="Early Childhood Education Provider">Early Childhood Education Provider</option> <option value="K-12 Education Provider">K-12 Education Provider</option> <option value="Higher Education Provider">Higher Education Provider</option> <option value="Other">Other</option> </select>

</div>
<div class="get-involved-row">
<label for="00Nd000000557U1" class="long-label">What stages from cradle to career most interest you?</label>
<select id="00Nd000000557U1" title="Cradle to Career Interests" name="00Nd000000557U1" multiple="multiple"> <option value="Early Childhood">Early Childhood</option> <option value="Elementary School">Elementary School</option> <option value="Middle School">Middle School</option> <option value="High School">High School</option> <option value="Higher Education">Higher Education</option> <option value="Career">Career</option> </select>

</div>
<div class="get-involved-row">

<label for="00Nd000000557SQ" class="long-label">Which K-12 districts do you work with or interact with most?</label>
<select id="00Nd000000557SQ" title="Districts" name="00Nd000000557SQ" multiple="multiple"> 
<option value="Carrollton/Farmers Branch">Carrollton/Farmers Branch</option> 
 <option value="Grapevine/Colleyville">Grapevine/Colleyville</option>
 <option value="Cedar Hill">Cedar Hill</option> 
 <option value="Highland Park">Highland Park</option> 
 <option value="Coppell">Coppell</option>
 <option value="Irving">Irving</option> 
 <option value="Dallas">Dallas</option> 
 <option value="Lancaster">Lancaster</option>
 <option value="DeSoto">DeSoto</option> 
 <option value="Mesquite">Mesquite</option> 
 <option value="Duncanville">Duncanville</option> 
  <option value="Richardson">Richardson</option> 
 <option value="Garland">Garland</option> 
 <option value="Uplift Education">Uplift Education</option>
 <option value="Grand Prairie">Grand Prairie</option> 
 <option value="Other">Other</option> </select>
</div>
<div class="get-involved-row">

<label for="00Nd000000557Ts" class="long-label">Do you or your organization belong to any groups or networks? If yes, please share.</label>
<textarea id="00Nd000000557Ts" name="00Nd000000557Ts"></textarea>
</div>

<input type="submit" name="submit" value="Submit" />

</form>
		
			
			
		<div class="clear"></div>
		</div><!-- .entry-content -->
		<?php endif; ?>	
			
		</div>
		<div class="clear"></div>
	</article>	




<?php get_footer(); ?>


<script type="text/javascript">
jQuery(document).ready(function() {
            jQuery("#00Nd000000557U1").dropdownchecklist({emptyText: "Click Here to select ..."});
 			jQuery("#00Nd000000557SQ").dropdownchecklist({emptyText: "Click Here to select ..."});
 			$('#00Nd000000557SQ .ui-dropdownchecklist-selector').trigger('click');
 			$('#00Nd000000557U1 .ui-dropdownchecklist-selector').trigger('click');
});
</script>
