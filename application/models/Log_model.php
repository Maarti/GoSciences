<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log_model extends MY_Model
{
        protected $table = 'log';
        
        // Créer une entrée dans la tables des logs. $user = null OU utilisateur.id OU utilisateur.mail
        public function create_log($type,$libelle,$detail="",$user=null){            
            try {
                $CI =& get_instance();
                $CI->load->model('utilisateur_model');
                $this->load->library('user_agent');
                if ($this->agent->is_browser())     $agent = 'Browser - '.$this->agent->browser().' '.$this->agent->version();
                elseif ($this->agent->is_robot())   $agent = 'Robot - '.$this->agent->robot();
                elseif ($this->agent->is_mobile())  $agent = 'Mobile - '.$this->agent->mobile();
                else                                $agent = 'Unidentified User Agent';
                $platform=$this->agent->platform();
                $ip=$this->input->ip_address();
                if (!is_null($user)){
                    if (!is_int($user)){
                        $user_obj = $CI->utilisateur_model->read('id',array('mail'=>$user))->row();
                        $user = (is_null($user_obj))? null : $user_obj->id;
                    }
                }
                
                $options_echappees = array(
                    'ip'            => $ip,
                    'agent'         => $agent,
                    'platform'      => $platform,
                    'type'          => $type,
                    'libelle'       => $libelle,
                    'detail'        => $detail,
                    'utilisateur_id'=> $user);
                $options_non_echappees = array('date' => 'NOW()');
                
                return $this->create($options_echappees, $options_non_echappees);
            } catch( Exception $e ) {
                log_message('error', 'Error in Log_model - Msg:'.$e->getMessage().' Trace:'.$e->getTraceAsString());
            }
        }
}