<?php
/*
	
	== PHP FILE TREE ==
	
		Let's call it...oh, say...version 1?
	
	== AUTHOR ==
	
		Cory S.N. LaViska
		http://abeautifulsite.net/
		
	== DOCUMENTATION ==
	
		For documentation and updates, visit http://abeautifulsite.net/notebook.php?article=21
		
*/

use yii\helpers\Url;

function php_file_tree($directory, $curso, $extensions = array())
{
    if (!isset($code))
        $code = '';
    if( substr($directory, -1) == "/" )
        $directory = substr($directory, 0, strlen($directory) - 1);
    $code .= php_file_tree_dir($directory, $curso, '', $extensions);
    return $code;
}

function php_file_tree_dir($directory, $curso, $ruta, $extensions = array(), $first_call = true)
{
    if( function_exists("scandir"))
        $file = scandir($directory);
    else
        $file = php4_scandir($directory);
    natcasesort($file);

    $files = $dirs = array();
    foreach($file as $this_file)
    {
        if( is_dir("$directory/$this_file"))
            $dirs[] = $this_file;
        else
            $files[] = $this_file;
    }
    $file = array_merge($dirs, $files);

    if(!empty($extensions))
    {
        foreach( array_keys($file) as $key )
        {
            if( !is_dir("$directory/$file[$key]") )
            {
                $ext = substr($file[$key], strrpos($file[$key], ".") + 1); 
                if(!in_array($ext, $extensions))
                    unset($file[$key]);
            }
        }
    }

    $php_file_tree = '';
    if (count($file) > 2)
    {
        $php_file_tree = "<ul";
        if ($first_call)
        {
            $php_file_tree .= " class=\"php-file-tree\"";
            $first_call = false;
        }
        $php_file_tree .= ">";
        $cant = 0;

        foreach( $file as $this_file )
        {
            $cant++;
            if ($this_file != "." && $this_file != "..")
            {
                if (is_dir("$directory/$this_file"))
                {
                    //Directory
                    $php_file_tree .= "<li class=\"pft-directory\"><a href=\"#\">" . htmlspecialchars($this_file) . "</a>";
                    $php_file_tree .= php_file_tree_dir("$directory/$this_file", $curso, "$ruta/$this_file", $extensions, false);
                    $php_file_tree .= "</li>";
                }
                else
                {
                    //File
                    $ext = "ext-" . substr($this_file, strrpos($this_file, ".") + 1);
                    $php_file_tree .= "<li class=\"pft-file " . strtolower($ext) . "\"><a href=\"" . Url::toRoute(["producto/descargar", "curso" => $curso, 'ruta' => $ruta, "fichero" => htmlspecialchars($this_file)]). "\">" . htmlspecialchars($this_file) . "</a></li>";
                }
            }
        }
        $php_file_tree .= "</ul>";
    }
    return $php_file_tree;
}

// For PHP4 compatibility
function php4_scandir($dir) {
	$dh  = opendir($dir);
	while( false !== ($filename = readdir($dh)) ) {
	    $files[] = $filename;
	}
	sort($files);
	return($files);
}
