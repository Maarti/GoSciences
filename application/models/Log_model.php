<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log_model extends CI_Model
{
        protected $table = 'log';
        
        // Créer une entrée dans la tables des logs. $user = null OU utilisateur.id OU utilisateur.mail
        public function create($type,$libelle,$detail="",$user=null){            
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
                    if (is_int($user)) $uid = $user;
                    else {
                        $user_info = $CI->utilisateur_model->getInfo('id','mail',$user);
                        $uid = (is_null($user_info))? null : $user_info->id;
                    }
                }else
                    $uid = null;

                $connexion_log = array(
                    'date'          => date("Y-m-j H:i:s"),
                    'ip'            => $ip,
                    'agent'         => $agent,
                    'platform'      => $platform,
                    'type'          => $type,
                    'libelle'       => $libelle,
                    'detail'        => $detail,
                    'utilisateur_id'=> $uid);

                return $this->db->insert($this->table, $connexion_log);
            } catch( Exception $e ) {
                log_message('error', 'Error in Log_model - Msg:'.$e->getMessage().' Trace:'.$e->getTraceAsString());
            }
        }
}