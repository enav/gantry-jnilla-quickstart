<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined('_JEXEC') or die;
jimport ( 'joomla.filesystem.folder' );
jimport ( 'joomla.filesystem.file' );

/**
 * Helper for plg_system_jnilla
 *
 */
class plgSystemJnillaHelper
{
	/**
	 * find and update all the importer.less files
	 */
	public static function updateLessImporters()
	{
		// declarations
		$app = JFactory::getApplication();
		$template = $app->getTemplate();
		$dirName = JPATH_SITE . "/templates/$template/less/";
		$folders = JFolder::listFolderTree($dirName, '', 20);

		foreach($folders as $folder)
		{
			$folderPath = $folder["fullname"];
			if(JFile::exists("$folderPath/importer.less"))
			{
				$files = JFolder::files($folderPath, '.less');
				if (count($files))
				{
					$content = "";
					foreach($files as $file)
					{
						if($file == "importer.less") continue;
						$content .= "@import \"$file\";\n";
					}
					$oldContent = file_get_contents("$folderPath/importer.less");
					if ($oldContent != $content)
					{
						JFile::write("$folderPath/importer.less", $content);
					}
				}
			}
		}
	}


	/**
	 * import and mix the files inside the js-importer folder
	 */
	public static function compileJsImporter()
	{
		// declarations
		$app = JFactory::getApplication();
		$template = $app->getTemplate();
		$dirName = JPATH_SITE . "/templates/$template/js-importer";

		if(JFolder::exists($dirName))
		{
			$files = JFolder::files($dirName, '.js');
			if (count($files))
			{
				// compile files
				$content = "";
				foreach($files as $file)
				{
					if($file == "jn-compiled.js" || self::isOverride("$dirName/$file")) continue;
					$file = self::getOverride("$dirName/$file", "basename");
					$content .= "\n";
					$content .= "// imported file: $file\n";
					$content .= "\n";
					$content .= trim(file_get_contents("$dirName/$file"))."\n\n\n";
				}
				// update compile file
				if(JFile::exists("$dirName/jn-compiled.js"))
				{
					$oldContent = file_get_contents("$dirName/jn-compiled.js");
				}
				else
				{
					$oldContent = "";
				}
				if ($oldContent != $content)
				{
					JFile::write("$dirName/jn-compiled.js", $content);
				}
			}
		}
	}

	/**
	 * return the override file path if exist
	 */
	public static function getOverride($path, $option="path")
	{
		$parts = pathinfo($path);
		$dirname = $parts['dirname'];
		$basename = $parts['basename'];
		$extension = $parts['extension'];
		$filename = $parts['filename']; // since PHP 5.2.0
		// get top level override
		do {
			$str[] = "override";
			$overridePath = "$dirname/$filename.".implode($str, '.').".$extension";
		} while (JFile::exists($overridePath));
		if(count($str)>1) array_pop($str);
		$overridePath = "$dirname/$filename.".implode($str, '.').".$extension";
		// return proper value
		switch ($option)
		{
			case "path":
				if(JFile::exists($overridePath))
				{
					return $overridePath;
				}
				else
				{
					return $path;
				}
				break;
			case "basename":
				if(JFile::exists($overridePath))
				{
					return "$filename.".implode($str, '.').".$extension";
				}
				else
				{
					return $basename;
				}
				break;
			case "exist":
				if(JFile::exists($overridePath))
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
		}
	}

	/**
	 * return true if the file in question is an override
	 */
	public static function isOverride($path, $option="path")
	{
		$parts = pathinfo($path);
		$filename = $parts['filename']; // since PHP 5.2.0
		preg_match('/.+\.override$/i', $filename, $result);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}







