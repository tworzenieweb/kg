<?php
class Template
{

	//ustawiam dwie zmienne
	//pierwsza bêdzie przechowywa³a plik z szablonem
	var $template_code;

	//druga bêdzie przechowywa³a dane wykorzystane we wzorcach
	var $dane; //Uwaga zmienna ta jest tablic±, wypada to zainicjowaæ mo¿na to zrobiæ tutaj
	//w postaci: var $dane = array(); zalecana jest jednak definicja zmiennych
	//w konstruktorze, tak te¿ zrobiê

	function LoadTemplateFile ( $file_name ) //konstruktor dla klasy szablon
	{
		if ( file_exists( $file_name ) )
		{
			$this->template_code = file('$file_name');
			$this->template_code = implode('', $this->template_code);
		}
	}
	
	function setVariable( $nazwa, $wartosc='' ) {//jak wcze¶niej wspomnia³em druga zmienna
		// teraz trzeba sprawdziæ argumenty //powinna mieæ warto¶æ domy¶ln±, na wypadek
		if ( is_array( $nazwa ) ) //gdyby argument by³ tablic±
		{
			$this->dane = array_merge($this->dane, $nazwa); //je¶li tablica
		} elseif ( !empty($wartosc) ) {
			$this->dane[$nazwa] = $wartosc; //je¶li zmienna z warto¶ci±
		}
	}
	
	//ostatnia funkcja bêdzie zamienia³a wzorce oraz je wy¶wietla³a, je¶li chcesz u¿yæ oddzielnej funkcji do wy¶wietlania, zdefiniuj jeszcze jedn± w³a¶ciwo¶æ, a nastêpnie w metodzie, któr± teraz zdefiniujê zapisz wynik do zdefiniowanej w³a¶ciwo¶ci, a nastêpnie zdefiniuj jeszcze jedna metodê, która bêdzie zwraca³a tylko w³a¶ciwo¶æ z przetworzonym szablonem
	
	function getCode()
	{	
		echo $this->dane[1];
		return preg_replace( "/{([^}]+)}/e", $this->dane['1'], $this->template_code );
		//metoda ta dopasuje wzorzec do indeksu w tablicy $dane, a nastêpnie zast±pi go odpowiedni± warto¶ci±, na koniec zwróci gotowy, ju¿ uzupe³niony szablon.
	} 

}

?>


