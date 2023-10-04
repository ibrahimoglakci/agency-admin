<?php


class DB
{



	var $server="localhost";
	var $username="root";
	var $password="";
	var $dbname="admin_agency";
	var $connection;

	function __construct()
	{

		try {

			$this->connection = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->dbname . ";charset=utf8", $this->username, $this->password);
		} catch (PDOException $error) {
			echo $error->getMessage();
			exit();
		}
	}


	public function uni($field, $value)
	{
		$stmt = $this->connection->prepare('SELECT ' . $field . ' FROM user WHERE seflink = :value');
		if ($stmt->execute(array(':value' => $value))) {
			return $stmt->rowCount();
		}
		//query failed, throw errors or something
	}


	public function CallData($table, $where = "", $wherearray = "", $orderby = "ORDER BY ID ASC", $limit = "")
	{
		$this->connection->query("SET CHARACTER SET utf8");
		$sql = "SELECT * FROM " . $table;
		if (!empty($where) && !empty($wherearray)) {

			$sql .= " " . $where;
			if (!empty($orderby)) {
				$sql .= " " . $orderby;
			}
			if (!empty($limit)) {
				$sql .= " LIMIT " . $limit;
			}

			$run = $this->connection->prepare($sql);
			$end = $run->execute($wherearray);
			$data = $run->fetchAll(PDO::FETCH_ASSOC);
		} else {
			if (!empty($orderby)) {
				$sql .= " " . $orderby;
			}
			if (!empty($limit)) {
				$sql .= " LIMIT " . $limit;
			}

			$data = $this->connection->query($sql, PDO::FETCH_ASSOC);
		}

		if ($data != false && !empty($data)) {
			$datas = array();
			foreach ($data as $infos) {
				$datas[] = $infos;
			}
			return $datas;
		} else {
			return false;
		}
	}


	public function RunQuery($table, $areaname = "", $dataarray = "", $limit = "")
	{
		$this->connection->query("SET CHARACTER SET utf8");
		if (!empty($areaname) && !empty($dataarray)) {


			$sql = $table . " " . $areaname;
			if (!empty($limit)) {
				$sql .= " LIMIT " . $limit;
			}
			$run = $this->connection->prepare($sql);
			$end = $run->execute($dataarray);
		} else {
			$sql = $table;
			if (!empty($limit)) {
				$sql .= " LIMIT " . $limit;
			}
			$end = $this->connection->exec($sql);
		}
		if ($end != false) {
			return true;
		} else {
			return false;
		}
		$this->connection->query("SET CHARACTER SET utf8");
	}

	public function setInterval($f, $milliseconds)
	{
		$seconds = (int)$milliseconds / 1000;
		while (true) {
			$f();
			sleep($seconds);
		}
	}


	public function convertMonthToTurkishCharacter($date)
	{
		$aylar = array(
			'January'    =>    'Ocak',
			'February'    =>    'Şubat',
			'March'        =>    'Mart',
			'April'        =>    'Nisan',
			'May'        =>    'Mayıs',
			'June'        =>    'Haziran',
			'July'        =>    'Temmuz',
			'August'    =>    'Ağustos',
			'September'    =>    'Eylül',
			'October'    =>    'Ekim',
			'November'    =>    'Kasım',
			'December'    =>    'Aralık',
			'Monday'    =>    'Pazartesi',
			'Tuesday'    =>    'Salı',
			'Wednesday'    =>    'Çarşamba',
			'Thursday'    =>    'Perşembe',
			'Friday'    =>    'Cuma',
			'Saturday'    =>    'Cumartesi',
			'Sunday'    =>    'Pazar',
			'Jan' => 'Oca',
			'Feb' => 'Şub',
			'Mar' => 'Mar',
			'Apr' => 'Nis',
			'May' => 'May',
			'Jun' => 'Haz',
			'Jul' => 'Tem',
			'Aug' => 'Ağu',
			'Sep' => 'Eyl',
			'Oct' => 'Eki',
			'Nov' => 'Kas',
			'Dec' => 'Ara'

		);
		return  strtr($date, $aylar);
	}












	public function addActivity($userID, $activity, $type, $date)
	{

		//$addactivities->$this->RunQuery("INSERT INTO aktivite","SET userID=?, activity=?, type=?, date=?",array($userID,$activity,$type,$date));

	}


	public function seflink($val)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '?', '*', '!', '.', '(', ')');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '', '', '', '', '', '');
		$string = strtolower(str_replace($find, $replace, $val));
		$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = str_replace(' ', '-', $string);
		return $string;
	}

	public function AddModule()
	{
		if (!empty($_POST["title"])) {
			$title = $_POST['title'];
			if (!empty($_POST["state"])) {
				$state = 1;
			} else {
				$state = 2;
			}
			$table = str_replace("-", "", $this->seflink($title));
			$check = $this->CallData("modules", "WHERE tables=?", array($table), "ORDER BY ID ASC", 1);
			if ($check != false) {
				return false;
			} else {
				$createtable = $this->RunQuery('CREATE TABLE IF NOT EXISTS `' . $table . '` (
					`ID` int(11) NOT NULL AUTO_INCREMENT,
					`title` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`seflink` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`category` int(11) DEFAULT NULL,
					`text` text COLLATE utf8_general_ci,
					`image` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`phone` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`adress` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`email` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`let` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`lng` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`seo` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`description` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
					`state` int(5) DEFAULT NULL,
					`rownumber` int(11) DEFAULT NULL,
					`date` date DEFAULT NULL,
					PRIMARY KEY (`ID`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;');
				$addmodule = $this->RunQuery("INSERT INTO modules", "SET title=?, tables=?, state=?, date=?", array($title, $table, $state, date("Y-m-d")));
				$addcategory = $this->RunQuery("INSERT INTO categories", "SET title=?, seflink=?, tables=?, state=?, date=?", array($title, $table, 'modul', 1, date("Y-m-d")));
				if ($addmodule != false) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}



	public function filter($val, $tf = false)
	{
		if ($tf == false) {
			$val = strip_tags($val);
		}
		$val = addslashes(trim($val));
		return $val;
	}

	public function uzanti($dosyaadi)
	{
		$parca = explode(".", $dosyaadi);
		$uzanti = end($parca);
		$donustur = strtolower($uzanti);
		return $donustur;
	}


	public function upload($nesnename, $yuklenecekyer = 'images/', $tur = 'img', $w = '', $h = '', $resimyazisi = '')
	{
		if ($tur == "img") {
			if (!empty($_FILES[$nesnename]["name"])) {
				$dosyanizinadi = $_FILES[$nesnename]["name"];
				$tmp_name = $_FILES[$nesnename]["tmp_name"];
				$uzanti = $this->uzanti($dosyanizinadi);
				if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {
					$classIMG = new upload($_FILES[$nesnename]);
					if ($classIMG->uploaded) {
						if (!empty($w)) {
							if (!empty($h)) {
								$classIMG->image_resize = true;
								$classIMG->image_x = $w;
								$classIMG->image_y = $h;
							} else {
								if ($classIMG->image_src_x > $w) {
									$classIMG->image_resize = true;
									$classIMG->image_ratio_y = true;
									$classIMG->image_x = $w;
								}
							}
						} else if (!empty($h)) {
							if ($classIMG->image_src_h > $h) {
								$classIMG->image_resize = true;
								$classIMG->image_ratio_x = true;
								$classIMG->image_y = $h;
							}
						}

						if (!empty($resimyazisi)) {
							$classIMG->image_text = $resimyazisi;

							$classIMG->image_text_direction = 'v';

							$classIMG->image_text_color = '#FFFFFF';

							$classIMG->image_text_position = 'BL';
						}
						$rand = uniqid(true);
						$classIMG->file_new_name_body = $rand;
						$classIMG->Process($yuklenecekyer);
						if ($classIMG->processed) {
							$resimadi = $rand . "." . $classIMG->image_src_type;
							return $resimadi;
						} else {
							return false;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else if ($tur == "ds") {

			if (!empty($_FILES[$nesnename]["name"])) {

				$dosyanizinadi = $_FILES[$nesnename]["name"];
				$tmp_name = $_FILES[$nesnename]["tmp_name"];
				$uzanti = $this->uzanti($dosyanizinadi);
				if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {

					$classIMG = new upload($_FILES[$nesnename]);
					if ($classIMG->uploaded) {
						$rand = uniqid(true);
						$classIMG->file_new_name_body = $rand;
						$classIMG->Process($yuklenecekyer);
						if ($classIMG->processed) {
							$dokuman = $rand . "." . $uzanti;
							return $dokuman;
						} else {
							return false;
						}
					}
				}
			}
		} else {
			return false;
		}
	}

	public function uploadMulti($nesnename, $tablo = 'nan', $KID = 1, $yuklenecekyer = 'images/', $tur = 'img', $w = '', $h = '', $resimyazisi = '')
	{
		if ($tur == "img") {
			if (!empty($_FILES[$nesnename]["name"][0])) {
				$dosyanizinadi = $_FILES[$nesnename]["name"][0];
				$tmp_name = $_FILES[$nesnename]["tmp_name"][0];
				$uzanti = $this->uzanti($dosyanizinadi);
				if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {
					$resimler = array();
					foreach ($_FILES[$nesnename] as $k => $l) {
						foreach ($l as $i => $v) {
							if (!array_key_exists($i, $resimler))
								$resimler[$i] = array();
							$resimler[$i][$k] = $v;
						}
					}

					foreach ($resimler as $resim) {
						$uzanti = $this->uzanti($resim["name"]);
						if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {
							$handle = new Upload($resim);
							if ($handle->uploaded) {

								/* Resmi Yeniden Adlandır */
								$rand = uniqid(true);
								$handle->file_new_name_body = $rand;

								/* Resmi Yeniden Boyutlandır */
								if (!empty($w)) {
									if (!empty($h)) {

										$handle->image_resize = true;
										$handle->image_x = $w;
										$handle->image_y = $h;
									} else {
										if ($handle->image_src_x > $w) {
											$handle->image_resize = true;
											$handle->image_x = $w;
											$handle->image_ratio_y = true;
										}
									}
								} else if (!empty($h)) {
									if ($handle->image_src_h > $h) {
										$handle->image_resize = true;
										$handle->image_y = $h;
										$handle->image_ratio_x = true;
									}
								}

								//üzerine yazı yazdırma
								if (!empty($resimyazisi)) {
									$handle->image_text   = $resimyazisi;
									$handle->image_text_color      = '#FFFFFF';
									$handle->image_text_opacity    = 90;
									//$handle->image_text_background = '#FFFFFF';
									$handle->image_text_background_opacity = 80;
									$handle->image_text_font       = 5;
									$handle->image_text_padding    = 1;
								}


								/* Resim Yükleme İzni */
								$handle->allowed = array('image/*');

								/* Resmi İşle */
								//$handle->Process(realpath("../")."/upload/resim/");
								$handle->Process($yuklenecekyer);
								if ($handle->processed) {
									$yukleme = $rand . "." . $handle->image_src_type;
									if (!empty($yukleme)) {
										//$yuklemekontrol=$fnk->DKontrol("../images/resimler/".$yukleme);
										$sira = $this->CallID("resimler");

										$sql = $this->RunQuery("INSERT INTO resimler", "SET tablo=?, KID=?, resim=?, tarih=?", array($tablo, $KID, $yukleme, date("Y-m-d")));
									} else {
										return false;
									}
								} else {
									return false;
								}

								$handle->Clean();
							} else {
								return false;
							}
						}
					}
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}



	public function callCategory($table, $selectID = "", $length = -1)
	{
		$length++;
		$category = $this->CallData("categories", "WHERE tables=?", array($table), "ORDER BY ID ASC");
		if ($category != false) {
			for ($q = 0; $q < count($category); $q++) {
				$categoryseflink = $category[$q]["seflink"];
				$categoryID = $category[$q]["ID"];
				if ($selectID == $categoryID) {
					echo '<option value="' . $categoryID . '" selected="selected">' . str_repeat("&nbsp;&nbsp;&nbsp;", $length) . stripslashes($category[$q]["title"]) . '</option>';
				} else {
					echo '<option value="' . $categoryID . '">' . str_repeat("&nbsp;&nbsp;&nbsp;", $length) . stripslashes($category[$q]["title"]) . '</option>';
				}
				if ($categoryseflink == $table) {
					break;
				}
				$this->callCategory($categoryseflink, $selectID, $length);
			}
		} else {
			return false;
		}
	}

	public function callCategory2($tablo, $sef = "", $secID = "", $uz = -1)
	{
		$USTKATID = false;
		if (!empty($secID)) {
			$okuma = $this->CallData("categories", "WHERE ID=?", array($secID), "ORDER BY ID ASC", 1);
			if ($okuma != false) {
				$tablodakiAdi = $okuma[0]["tablo"];
				if ($tablodakiAdi != "modul") {
					$kontrol = $this->CallData("categories", "WHERE seflink=?", array($tablodakiAdi), "ORDER BY ID ASC", 1);
					if ($kontrol != false) {
						$USTKATID = $kontrol[0]["ID"];
					}
				}
			}
		}
		$uz++;

		$kategoriler = $this->CallData("categories", "WHERE tablo=?", array($tablo), "ORDER BY sirano ASC");
		if ($kategoriler != false) {
			for ($x = 0; $x < count($kategoriler); $x++) {
				$kategoriseflink = $kategoriler[$x]["seflink"];
				$kategoriID = $kategoriler[$x]["ID"];
				if ($USTKATID != false && $USTKATID == $kategoriID) {
					$seciliyap = ' selected="selected"';
				} else {
					$seciliyap = '';
				}
				if ($sef == "modul") {
					echo '<option value="' . $kategoriseflink . '"' . $seciliyap . '>' . str_repeat("&nbsp;&nbsp;&nbsp;", $uz) . ' ' . stripslashes($kategoriler[$x]["baslik"]) . '</option>';
				} else {
					echo '<option value="' . $kategoriseflink . '"' . $seciliyap . '>' . str_repeat("&nbsp;&nbsp;&nbsp;", $uz) . ' ' . stripslashes($kategoriler[$x]["baslik"]) . '</option>';
				}

				if ($kategoriseflink == $tablo) {
					break;
				}
				$this->callCategory2($kategoriseflink, $kategoriseflink, $secID, $uz);
			}
		} else {
			return false;
		}
	}


	public function simpleCategory($table, $selectID = "", $length = -1)
	{
		$length++;
		$category = $this->CallData("categories", "WHERE seflink=? AND tables=?", array($table, "module"), "ORDER BY ID ASC");
		if ($category != false) {
			for ($q = 0; $q < count($category); $q++) {
				$categoryseflink = $category[$q]["seflink"];
				$categoryID = $category[$q]["ID"];
				if ($selectID == $categoryID) {
					echo '<option value="' . $categoryID . '" selected="selected">' . str_repeat("&nbsp;&nbsp;&nbsp;", $length) . stripslashes($category[$q]["title"]) . '</option>';
				} else {
					echo '<option value="' . $categoryID . '">' . str_repeat("&nbsp;&nbsp;&nbsp;", $length) . stripslashes($category[$q]["title"]) . '</option>';
				}
			}
		} else {
			return false;
		}
	}


	public function CallID($tablo)
	{
		$sql = $this->connection->query("SHOW TABLE STATUS FROM `" . $this->dbname . "` LIKE '" . $tablo . "'");
		if ($sql != false) {
			foreach ($sql as $result) {
				$IDbilgisi = $result["Auto_increment"];
				return $IDbilgisi;
				break;
			}
		} else {
			return false;
		}
	}

	public function sendMail($gonderenmail, $adsoyad, $konu, $title, $mesaj)
	{
		$checkemail = $this->CallData("postakutusu", "WHERE konu=? AND gonderenmail=?", array($konu, $gonderenmail), "ORDER BY ID ASC");

		if ($checkemail != false) {
			echo "<div class='alert alert-danger'>Lütfen daha önce gönderilen formu tekrar göndermeyiniz!</div>";
		} else {
			$sendmail = $this->RunQuery("INSERT INTO postakutusu", "SET gonderenmail=?, adsoyad=?, konu=?, baslik=?, mesaj=?, okundu_bilgisi=?, durum=?", array($gonderenmail, $adsoyad, $konu, $title, $mesaj, 0, 1));
			if ($sendmail != false) {
				echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Görüşleriniz başarıyla iletildi. En kısa süre içerisinde sizlerle iletişime geçeceğiz.</div>';
			} else {
				echo '<div class="alert alert-danger"><i class="fa fa-times-circle"></i> İşleminiz sırasında bir sorunla
				karşılaşıldı. Lütfen daha sonra tekrar
				deneyiniz.</div>';
			}
		}
	}


	public function MailGonder($mail, $adsoyad, $konu, $title, $mesaj)
	{

		$mailsettings = $this->CallData("mail_ayarlari", "WHERE ID=?", array(1), "ORDER BY ID ASC", 1);
		if ($mailsettings != false) {
			$host = $mailsettings[0]["server"];
			$smtpusername = $mailsettings[0]["mail"];
			$smtppassword = $mailsettings[0]["sifre"];
			$smtpport = $mailsettings[0]["port"];
			$smtpsertifika = $mailsettings[0]["sertifika"];
		}


		$posta = new PHPMailer(true);
		try {
			$posta->SMTPDebug = 0;
			$posta->isSMTP();
			$posta->CharSet = 'UTF-8';
			$posta->Host = $host;
			$posta->SMTPAuth = true;
			$posta->Username = $smtpusername;
			$posta->Password = $smtppassword;
			$posta->SMTPSecure = $smtpsertifika;
			$posta->Port = $smtpport;
			$posta->setFrom($smtpusername, $title);
			$posta->addAddress($mail, $adsoyad);
			$posta->isHTML(true);
			$posta->Subject = $konu;




			$posta->Body =  $mesaj;



			$posta->send();

			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

			return false;
		}
	}



	public function TekilCogul()
	{
		date_default_timezone_set('Europe/Istanbul');
		$tarih = date("Y-m-d");
		$IP = $this->ipGetir();
		$TARAYICI = $this->tarayiciGetir();
		$tarayicistatistic = $this->CallData("ziyarettarayici", "", "", "ORDER BY ID ASC");

		$konts = $this->CallData("ziyaretciler", "WHERE tarih=? AND IP=?", array($tarih, $IP), "ORDER BY ID ASC", 1);
		if ($konts == false) {
			if (!empty($_COOKIE["siteSettingsUse"])) {
			} else {
				$eks = $this->RunQuery("INSERT INTO ziyaretciler", "SET IP=?, tarayici=?, tekil=?, cogul=?, xr=?, tarih=?", array($IP, $TARAYICI, 1, 1, 1, $tarih));
				@setcookie("siteSettingsUse", md5(rand(1, 99999)), time() + (60 * 60 * 8));
				if ($TARAYICI == "Google Chrome") {
					$tbl = ($tarayicistatistic[0]["ziyaret"] + 1);
					$tiid = $tarayicistatistic[0]["ID"];
					$ersa = $this->RunQuery("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
				} else if ($TARAYICI == "İnternet Explorer") {
					$tbl = ($tarayicistatistic[1]["ziyaret"] + 1);
					$tiid = $tarayicistatistic[1]["ID"];
					$ersa = $this->RunQuery("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
				} else if ($TARAYICI == "Firefox") {
					$tbl = ($tarayicistatistic[2]["ziyaret"] + 1);
					$tiid = $tarayicistatistic[2]["ID"];
					$ersa = $this->RunQuery("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
				} else if ($TARAYICI == "Opera") {
					$tbl = ($tarayicistatistic[3]["ziyaret"] + 1);
					$tiid = $tarayicistatistic[3]["ID"];
					$ersa = $this->RunQuery("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
				} else if ($TARAYICI == "Edge") {
					$tbl = ($tarayicistatistic[4]["ziyaret"] + 1);
					$tiid = $tarayicistatistic[4]["ID"];
					$ersa = $this->RunQuery("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
				} else {
					$tbl = ($tarayicistatistic[5]["ziyaret"] + 1);
					$tiid = $tarayicistatistic[5]["ID"];
					$ersa = $this->RunQuery("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
				}
			}
		} else {
			$c = ($konts[0]["cogul"] + 1);
			$ID = $konts[0]["ID"];
			$gunc = $this->RunQuery("UPDATE ziyaretciler", "SET cogul=? WHERE ID=?", array($c, $ID), 1);
		}

		/*sayfa hızı hesaplama*/
		$start = microtime(true);
		$end = microtime(true);
		$time = mb_substr(($end - $start), 0, 4);
		$tarah = $this->RunQuery("UPDATE ziyarettarayici", "SET hiz=? WHERE ID=?", array($time, 5), 1);
	}
	public function tarayiciGetir()
	{
		$tarayiciBul = $_SERVER["HTTP_USER_AGENT"];
		$msie = strpos($tarayiciBul, 'MSIE') ? true : false;
		$firefox = strpos($tarayiciBul, 'Firefox') ? true : false;
		$chrome = strpos($tarayiciBul, 'Chrome') ? true : false;
		$opera = strpos($tarayiciBul, 'Opera Mini') ? true : false;
		$edge = strpos($tarayiciBul, 'Edge') ? true : false;
		if (!empty($msie) && $msie != false) {
			$tarayici = "İnternet Explorer";
		} else if (!empty($firefox) && $firefox != false) {
			$tarayici = "Firefox";
		} else if (!empty($chrome) && $chrome != false) {
			$tarayici = "Google Chrome";
		} else if (!empty($opera) && $opera != false) {
			$tarayici = "Opera";
		} else if (!empty($edge) && $edge != false) {
			$tarayici = "Edge";
		} else {
			$tarayici = "Diğer";
		}
		return $tarayici;
	}
	public function ipGetir()
	{
		if (getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif (getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode(',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
			$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}

	public function ziyaretciChrome()
	{
		$analiz = $this->CallData("ziyaretciler", "WHERE tarayici=?", array("Google Chrome"), "ORDER BY ID ASC");
		$totalziyaretcichrome = 0;
		if ($analiz != false) {


			$totalziyaretcichrome = $totalziyaretcichrome + count($analiz);
		} else {
			$totalziyaretcichrome = 0;
		}

		return $totalziyaretcichrome;
	}

	public function ziyaretciOpera()
	{
		$analizop = $this->CallData("ziyaretciler", "WHERE tarayici=?", array("Opera"), "ORDER BY ID ASC");
		$totalziyaretciopera = 0;
		if ($analizop != false) {


			$totalziyaretciopera = $totalziyaretciopera + count($analizop);
		} else {
			$totalziyaretciopera = 0;
		}

		return $totalziyaretciopera;
	}

	public function ziyaretciIE()
	{
		$analizie = $this->CallData("ziyaretciler", "WHERE tarayici=?", array("İnternet Explorer"), "ORDER BY ID ASC");
		$totalziyaretciie = 0;
		if ($analizie != false) {


			$totalziyaretciie = $totalziyaretciie + count($analizie);
		} else {
			$totalziyaretciie = 0;
		}

		return $totalziyaretciie;
	}

	public function ziyaretciFireFox()
	{
		$analizff = $this->CallData("ziyaretciler", "WHERE tarayici=?", array("Firefox"), "ORDER BY ID ASC");
		$totalziyaretciff = 0;
		if ($analizff != false) {


			$totalziyaretciff = $totalziyaretciff + count($analizff);
		} else {
			$totalziyaretciff = 0;
		}

		return $totalziyaretciff;
	}

    public function ziyaretciDiger()
	{
		$analizd = $this->CallData("ziyaretciler", "WHERE tarayici=?", array("Diğer"), "ORDER BY ID ASC");
		$totalziyaretcid = 0;
		if ($analizd != false) {


			$totalziyaretcid = $totalziyaretcid + count($analizd);
		} else {
			$totalziyaretcid = 0;
		}

		return $totalziyaretcid;
	}




	/** MUHASEBE İŞLEMLERİ */

	public function totalUsers()
	{

		$totalusers = $this->CallData("kullanicilar", "", "", "ORDER BY ID ASC");

		if ($totalusers != false) {
			return count($totalusers);
		}
		return 0;
	}

	public function totalCustomers()
	{

		$totalcustomers = $this->CallData("musteriler", "", "", "ORDER BY ID ASC");

		if ($totalcustomers != false) {
			return count($totalcustomers);
		}
		return 0;
	}

	public function totalcustomerchangeMonth()
	{

		$totalcustomers = $this->CallData("musteriler", "", "", "ORDER BY ID ASC");

		if ($totalcustomers != false) {
			return count($totalcustomers);
		}
		return 0;
	}

	public function toplamSiparisGelir()
	{
		$toplamsiparisgelir = $this->CallData("siparisgelir", "", "", "ORDER BY ID ASC");

		$totalsiparisgelir = 0;
		for ($sgelir = 0; $sgelir < count($toplamsiparisgelir); $sgelir++) {

			$totalsiparisgelir = $totalsiparisgelir + $toplamsiparisgelir[$sgelir]["gelir"];
		}
		return $totalsiparisgelir;
	}

	public function toplamSiparisGider()
	{
		$toplamsiparisgider = $this->CallData("siparisgider", "", "", "ORDER BY ID ASC");

		$totalsiparisgider = 0;
		for ($sggider = 0; $sggider < count($toplamsiparisgider); $sggider++) {

			$totalsiparisgider = $totalsiparisgider + $toplamsiparisgider[$sggider]["gider"];
		}
		return $totalsiparisgider;
	}



	public function toplamSiparisKar()
	{

		$gelirsiparis = $this->toplamSiparisGelir();
		$gidersiparis = $this->toplamSiparisGider();

		$toplamkar = $gelirsiparis - $gidersiparis;

		return number_format($toplamkar);
	}



	public function toplamSirketGider()
	{
		$toplamsirketgider = $this->CallData("sirketgider", "", "", "ORDER BY ID ASC");

		$totalsirketgider = 0;
		for ($sirggider = 0; $sirggider < count($toplamsirketgider); $sirggider++) {

			$totalsirketgider = $totalsirketgider + $toplamsirketgider[$sirggider]["gider"];
		}
		return $totalsirketgider;
	}

	public function toplamKar()
	{

		$gelirsiparis = $this->toplamSiparisGelir();
		$gidersiparis = $this->toplamSiparisGider();
		$gidersirkett = $this->toplamSirketGider();

		$giderlermedya = $gidersiparis + $gidersirkett;

		$toplammedyakar = $gelirsiparis - $giderlermedya;

		return number_format($toplammedyakar);
	}






	public function toplamSatis()
	{

		$toplamsatis = $this->CallData("siparisler", "WHERE onizleme_durum=?", array(1), "ORDER BY ID ASC");

		$totalsatis = 0;
		if ($toplamsatis != false) {
			for ($satis = 0; $satis < count($toplamsatis); $satis++) {

				$totalsatis = $totalsatis + $toplamsatis[$satis]["siparis_tutari"];
			}
		}
		else {
			$totalsatis=0;
		}
		return $totalsatis;
	}

	public function aylikSatis()
	{

		$currentdate = date("Y-m-d");

		$newdate = date("Y-m-d", strtotime('-1 month', strtotime($currentdate)));

		$returndate = date("m", strtotime($newdate));

		$ayliksatis = $this->CallData("siparisler", "WHERE onizleme_durum=? AND MONTH(tarih)=?", array(1, $returndate), "ORDER BY ID ASC");
		
		if ($ayliksatis != false) {
		$totalasatis = 0;
			for ($asatis = 0; $asatis < count($ayliksatis); $asatis++) {

				$totalasatis = $totalasatis + $ayliksatis[$asatis]["siparis_tutari"];
			}
		}
		else {
			$totalasatis = 0;
		}
		return number_format($totalasatis);
	}

	public function toplamVergiTutari()
	{
		$toplamvergiler = $this->CallData("vergiler", "", "", "ORDER BY ID ASC");

		$totalvergiler = 0;
		if ($toplamvergiler != false) {
			for ($vergi = 0; $vergi < count($toplamvergiler); $vergi++) {

				$totalvergiler = $totalvergiler + $toplamvergiler[$vergi]["vergi_tutari"];
			}
		}
		return number_format($totalvergiler);
	}

	public function yillikGelir()
	{

		$currentyillikgelir = date("Y-m-d");

		$newdateyillikgelir = date("Y-m-d", strtotime($currentyillikgelir));

		$returndatyillikgelir = date("Y", strtotime($newdateyillikgelir));
		$totalyillikgelir = 0;
		$yillikgelir = $this->CallData("siparisgelir", "WHERE YEAR(tarih)=?", array($returndatyillikgelir), "ORDER BY ID ASC");

		if($yillikgelir!=false) {
			for ($yillikg = 0; $yillikg < count($yillikgelir); $yillikg++) {

				$totalyillikgelir = $totalyillikgelir + $yillikgelir[$yillikg]["gelir"];
			}
		}


		$totalyillikgelir=0;

		return number_format($totalyillikgelir);
	}

	public function aylikVergiTutari()
	{

		$currentdatevergi = date("Y-m-d");

		$newdatevergi = date("Y-m-d", strtotime('-1 month', strtotime($currentdatevergi)));

		$returndatevergi = date("m", strtotime($newdatevergi));

		$aylikvergi = $this->CallData("vergiler", "WHERE MONTH(tarih)=?", array($returndatevergi), "ORDER BY ID ASC");

		
		if ($aylikvergi == false) {
			$totalavergi = 0;
		} else {
			$totalavergi = 0;
			for ($avergi = 0; $avergi < count($aylikvergi); $avergi++) {

				$totalavergi = $totalavergi + $aylikvergi[$avergi]["vergi_tutari"];
			}
		}

		return number_format($totalavergi);
	}

	public function aylikCiroTutari()
	{

		$currentdateciro = date("Y-m-d");

		$newdateciro = date("Y-m-d", strtotime('-1 month', strtotime($currentdateciro)));

		$returndateciro = date("m", strtotime($newdateciro));

		$aylikciro = $this->CallData("siparisgelir", "WHERE MONTH(tarih)=?", array($returndateciro), "ORDER BY ID ASC");


		if ($aylikciro == false) {
			$totalciro = 0;
		} else {
			$totalciro = 0;
			for ($ciro = 0; $ciro < count($aylikciro); $ciro++) {

				$totalciro = $totalciro + $aylikciro[$ciro]["gelir"];
			}
		}

		return $totalciro;
	}

	public function toplamMasraflar()
	{

		$toplamsirketgider = $this->toplamSirketGider();
		$toplamsiparisgider = $this->toplamSiparisGider();

		$toplammasraflar = $toplamsirketgider + $toplamsiparisgider;

		return number_format($toplammasraflar);
	}

	public function aylikMusteriSayisi()
	{

		$currentdatemusteri = date("Y-m-d");

		$newdatemusteri = date("Y-m-d", strtotime('-1 month', strtotime($currentdatemusteri)));

		$returndatmusteri = date("m", strtotime($newdatemusteri));

		$aylikmusteri = $this->CallData("musteriler", "WHERE MONTH(tarih)=?", array($returndatmusteri), "ORDER BY ID ASC");

		$totalmusteri = 0;
		for ($musteri = 0; $musteri < count($aylikmusteri); $musteri++) {

			$totalmusteri = $totalmusteri + $musteri;
		}
		return number_format($totalmusteri);
	}
	public function aylikUlasilanMusteriSayisi()
	{

		$currentdateumusteri = date("Y-m-d");

		$newdateumusteri = date("Y-m-d", strtotime('-1 month', strtotime($currentdateumusteri)));

		$returndatumusteri = date("m", strtotime($newdateumusteri));

		$aylikumusteri = $this->CallData("ulasilan_musteriler", "WHERE MONTH(tarih)=?", array($returndatumusteri), "ORDER BY ID ASC");

		$totalumusteri = 0;

		$totalumusteri = $totalumusteri + ($aylikumusteri) ? count($aylikumusteri) : 0;


		return ($totalumusteri) ? number_format($totalumusteri) : 0;
	}

	public function yillikUlasilanMusteriSayisi()
	{

		$currentdateymusteri = date("Y-m-d");

		$newdateymusteri = date("Y-m-d", strtotime($currentdateymusteri));

		$returndatymusteri = date("Y", strtotime($newdateymusteri));
		$totalymusteri = 0;
		$aylikymusteri = $this->CallData("ulasilan_musteriler", "WHERE YEAR(tarih)=?", array($returndatymusteri), "ORDER BY ID ASC");




		$totalymusteri = $totalymusteri + ($aylikymusteri) ? count($aylikymusteri) : 0;

		return number_format($totalymusteri);
	}


	public function teslimedilenSiparisYuzdelikArtis()
	{

		$currentdatesiparisyuzdelikartis = date("Y-m-d");

		$newdatesiparisyuzdelikartis = date("Y-m-d", strtotime('-1 month', strtotime($currentdatesiparisyuzdelikartis)));

		$returndatesiparisyuzdelikartis = date("m", strtotime($newdatesiparisyuzdelikartis));



		$ayliksatissiparisyuzdelikartis = $this->CallData("siparisler", "WHERE siparis_durumu=? AND MONTH(tarih)=?", array("Teslim Edildi", $returndatesiparisyuzdelikartis), "ORDER BY ID ASC");
		$simdisiparisyuzdelikartis = $this->CallData("siparisler", "WHERE siparis_durumu=? AND MONTH(tarih)=?", array("Teslim Edildi", date("m")), "ORDER BY ID ASC");


		$eski = ($ayliksatissiparisyuzdelikartis) ? count($ayliksatissiparisyuzdelikartis) : 0;
		$yeni = ($simdisiparisyuzdelikartis) ? count($simdisiparisyuzdelikartis) : 0;

		if ($eski > 0 && $yeni > 0) {
			$formul = (($yeni - $eski) / $eski) * 100;
		} else {
			$formul = 0;
		}



		$totalasatissiparisyuzdelikartis = $formul;

		return $totalasatissiparisyuzdelikartis;
	}

	public function iptaledilenSiparisYuzdelikArtis()
	{

		$currentdateiptalsiparisyuzdelikartis = date("Y-m-d");

		$newdateiptalsiparisyuzdelikartis = date("Y-m-d", strtotime('-1 month', strtotime($currentdateiptalsiparisyuzdelikartis)));

		$returndateiptalsiparisyuzdelikartis = date("m", strtotime($newdateiptalsiparisyuzdelikartis));



		$ayliksatisiptalsiparisyuzdelikartis = $this->CallData("siparisler", "WHERE siparis_durumu=? AND MONTH(tarih)=?", array("İptal Edildi", $returndateiptalsiparisyuzdelikartis), "ORDER BY ID ASC");
		$simdiiptalsiparisyuzdelikartis = $this->CallData("siparisler", "WHERE siparis_durumu=? AND MONTH(tarih)=?", array("İptal Edildi", date("m")), "ORDER BY ID ASC");

		if ($ayliksatisiptalsiparisyuzdelikartis != false && $simdiiptalsiparisyuzdelikartis != false) {
			$eskiiptal = count($ayliksatisiptalsiparisyuzdelikartis);
			$yeniiptal = count($simdiiptalsiparisyuzdelikartis);


			if ($eskiiptal > 0 && $yeniiptal > 0) {
				$formuliptal = (($yeniiptal - $eskiiptal) / $eskiiptal) * 100;
			} else {
				$formuliptal = 0;
			}
			$totalasatisiptalsiparisyuzdelikartis = $formuliptal;
		} else {
			$totalasatisiptalsiparisyuzdelikartis = 0;
		}





		return $totalasatisiptalsiparisyuzdelikartis;
	}
}
