<?php
class Template
{

	//ustawiam dwie zmienne
	//pierwsza b�dzie przechowywa�a plik z szablonem
	var $template_code;

	//druga b�dzie przechowywa�a dane wykorzystane we wzorcach
	var $dane; //Uwaga zmienna ta jest tablic�, wypada to zainicjowa� mo�na to zrobi� tutaj
	//w postaci: var $dane = array(); zalecana jest jednak definicja zmiennych
	//w konstruktorze, tak te� zrobi�

	function LoadTemplateFile ( $file_name ) //konstruktor dla klasy szablon
	{
		if ( file_exists( $file_name ) )
		{
			$this->template_code = file('$file_name');
			$this->template_code = implode('', $this->template_code);
		}
	}
	
	function setVariable( $nazwa, $wartosc='' ) {//jak wcze�niej wspomnia�em druga zmienna
		// teraz trzeba sprawdzi� argumenty //powinna mie� warto�� domy�ln�, na wypadek
		if ( is_array( $nazwa ) ) //gdyby argument by� tablic�
		{
			$this->dane = array_merge($this->dane, $nazwa); //je�li tablica
		} elseif ( !empty($wartosc) ) {
			$this->dane[$nazwa] = $wartosc; //je�li zmienna z warto�ci�
		}
	}
	
	//ostatnia funkcja b�dzie zamienia�a wzorce oraz je wy�wietla�a, je�li chcesz u�y� oddzielnej funkcji do wy�wietlania, zdefiniuj jeszcze jedn� w�a�ciwo��, a nast�pnie w metodzie, kt�r� teraz zdefiniuj� zapisz wynik do zdefiniowanej w�a�ciwo�ci, a nast�pnie zdefiniuj jeszcze jedna metod�, kt�ra b�dzie zwraca�a tylko w�a�ciwo�� z przetworzonym szablonem
	
	function getCode()
	{	
		echo $this->dane[1];
		return preg_replace( "/{([^}]+)}/e", $this->dane['1'], $this->template_code );
		//metoda ta dopasuje wzorzec do indeksu w tablicy $dane, a nast�pnie zast�pi go odpowiedni� warto�ci�, na koniec zwr�ci gotowy, ju� uzupe�niony szablon.
	} 

}

?>


