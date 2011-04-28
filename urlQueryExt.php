<?php
class urlQueryExt extends Frontend
{
    public function generateFrontendUrl($objPage, $strParams,$strUrl)
    {
       
       if($objPage['querys'])
       {
	     $queryArr = deserialize($objPage['querys'],true);
	     $newQueryArr = array();
	     
	     foreach($queryArr AS $query) if(strstr($query,"&#61;"))
	     { 
		$qa = explode("&#61;",$query);
		$newQueryArr[] = $qa[0].'/'.$qa[1];	    	      
	     }
	     $strParams = count($newQueryArr)>0?'/'.implode('/',$newQueryArr):'';
	     $strUrl = ($GLOBALS['TL_CONFIG']['rewriteURL'] ? '' : 'index.php/') . (strlen($objPage['alias']) ? $objPage['alias'] : $objPage['id']) . $strParams . $GLOBALS['TL_CONFIG']['urlSuffix'];
    
	    if ($GLOBALS['TL_CONFIG']['disableAlias'])
	    {
		    $strRequest = '';
    
		    if ($newQueryArr)
		    {
			    $arrChunks = explode('/', preg_replace('@^/@', '', $strParams));
    
			    for ($i=0; $i<count($arrChunks); $i=($i+2))
			    {
				    $strRequest .= sprintf('&%s=%s', $arrChunks[$i], $arrChunks[($i+1)]);
			    }
		    }
    
		    $strUrl = 'index.php?id=' . $arrRow['id'] . $strRequest;
	    }
		  
       }
       return  $strUrl;
       
    }
}
?>