<?php
function fazAlerta($tipo, $titulo, $msg){
	$res = '<div class="alert alert-'.$tipo.' alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h6 class="alert-heading">'.$titulo.'</h6> '.$msg.'</div>';
	
	return $res;
}

function fazNotificacao($tipo, $msg){
	$res = '
	notify("top", "center", "", "'.$tipo.'", "animated fadeInDown", "animated fadeOutDown", "", "'.$msg.'");
	';
	
	return $res;
}

function TituloToLink($str){
	$ini = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À', 'Ã','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','(',')', '.',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º', '\'', '“', '”', '+' );

    $rep = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','a','a','a','e','i','o','u','n','n','c','c','-','' ,'' , '' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' , '', '', '', '', '' );

    return str_replace($ini, $rep, strtolower($str));
}

function retirarAcentos($str){
	$ini = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','(',')', '.',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º', '\'', '“', '”' );

    $rep = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','' ,'' , '' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' , '', '', '', '' );

    return str_replace($ini, $rep, strtolower($str));
}

function diffDateMinutos($minutos){
	//Comparando Agora
	if($minutos < 1){
		return ' agora';
	}
	//Comparando hora
	else if($minutos < 60){
		return ' há '.$minutos.' minutos'; //retornando minutos
	}
	//Comparando dia
	else if($minutos/60 < 24){
		$val = floor($minutos/60);
		return ($val == 1) ? ' há '.$val.' hora' : ' há '.$val.' horas'; //retornando horas
	}
	//Comparando meses
	else if($minutos/1440 < 32){
		$val = floor($minutos/1440);
		return ($val == 1) ? ' há '.$val.' dia' : ' há '.$val.' dias'; //retornando dias
	}
	//Comparando anos
	else if($minutos/1440 < 365){
		$val = floor($minutos/43200);
		return ($val == 1) ? ' há '.$val.' mês' : ' há '.$val.' meses'; //retornando meses
	}
	else{
		return 'há mais de 1 ano';
	}
}

function diffDateDias($dt1, $dt2){ //formato da data yyyy-mm-dd
	$diferenca = strtotime($dt1) - strtotime($dt2); //diferença em segundos

	//Calcula a diferença em dias
	$dias = floor($diferenca / (60 * 60 * 24));

	return $dias;
}

function paginacao_links($limitpage, $uri, $url, $sql, $model){
	// Elementos da Paginação
	$CI =& get_instance();
    $CI->load->library('pagination');

	$limit_per_page = $limitpage;

	//Buscando Jornais - Total de Registros
	$res = $model->fmSearchQuery($sql);

	if($res){
		//Total de Registros
	    $total_records = count($res);

		// paging configuration
		$config['base_url'] = $url;
	    $config['total_rows'] = $total_records;
	    $config['per_page'] = $limit_per_page;
	    $config["uri_segment"] = $uri;
	    
	    // custom paging configuration
	    $config['num_links'] = 5;
	    $config['use_page_numbers'] = TRUE;
	    $config['reuse_query_string'] = TRUE;
	     
	    $config['full_tag_open'] = '<nav class="paginacao"><div class="column float-right"><ul class="pages">';
	    $config['full_tag_close'] = '</ul></div></nav>';
	     
	    $config['first_link'] = 'Primeira';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	     
	    $config['last_link'] = 'Última';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	     
	    $config['next_link'] = '&raquo;';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

	    $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	     
	    $CI->pagination->initialize($config);

	    return $CI->pagination->create_links();
	}
	else return null;
}

function round_up($value, $precision){ 
    $pow = pow ( 10, $precision ); 
    
    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
}

function mask($val, $mask){
	$maskared = '';
	$k = 0;
	
	for($i = 0; $i<=strlen($mask)-1; $i++){
		if($mask[$i] == '#'){
			if(isset($val[$k]))
				$maskared .= $val[$k++];
		}
		else{
			if(isset($mask[$i]))
				$maskared .= $mask[$i];
		}
	}
	return $maskared;
}

function listEventos(){
	$CI =& get_instance();
	$CI->load->model('/Padrao_Model', 'PadraoM');

	$html = '<li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="feather icon-grid"></i></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Eventos</h6>
                        </div>
                        <ul class="noti-body">';

	//Buscando Eventos
	$res = $CI->PadraoM->fmSearchQuery("SELECT * FROM evento WHERE evesituacao <> 2");

	if(count($res) > 1){
		foreach($res as $r){
			$cor = ($r->id == $CI->session->userdata('quiz_ideventoativo')) ? 'text-primary' : null;

			$html .= '<a class="'.$cor.'" href="'.site_url("painel/Home/selecionaEvento/".$r->id).'"><li class="notification"><strong>'.$r->evenome.'</strong></li></a>';
		}

		$html .= '</ul>
                </div>
            </div>
        </li>';

		return $html;
	}
	else{
		return null;
	}
}