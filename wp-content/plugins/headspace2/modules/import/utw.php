<?php

/**
 * HeadSpace
 *
 * @package HeadSpace
 * @author John Godley
 * @copyright Copyright (C) John Godley
 **/

/*
============================================================================================================
This software is provided "as is" and any express or implied warranties, including, but not limited to, the
implied warranties of merchantibility and fitness for a particular purpose are disclaimed. In no event shall
the copyright owner or contributors be liable for any direct, indirect, incidental, special, exemplary, or
consequential damages (including, but not limited to, procurement of substitute goods or services; loss of
use, data, or profits; or business interruption) however caused and on any theory of liability, whether in
contract, strict liability, or tort (including negligence or otherwise) arising in any way out of the use of
this software, even if advised of the possibility of such damage.

For full license details see license.txt
============================================================================================================ */

class ImportUTW extends HS_Importer
{
	function name ()
	{
		return __ ('Ultimate Tag Warrior', 'headspace');
	}

	function import ()
	{
		$count = 0;

		global $wpdb;
		$values = $wpdb->get_results ("SELECT {$wpdb->prefix}post2tag.post_id,{$wpdb->prefix}tags.tag FROM {$wpdb->prefix}tags,{$wpdb->prefix}post2tag WHERE {$wpdb->prefix}tags.tag_id={$wpdb->prefix}post2tag.tag_id");
		if ($values)
		{
			$data = array ();
			foreach ($values AS $value)
				$data[$value->post_id][] = $value->tag;

			foreach ($data AS $postid => $values)
				MetaData::add_tags ($postid, implode (',', $values));

			$count += count ($values);
		}

		return $count;
	}

	function cleanup ()
	{
	}
}
