<?php
class Formatter extends CFormatter {
	public $booleanState;
        public $numberFormat=array('currencySimbol'=>'$ ','decimals'=>2, 'decimalSeparator'=>',', 'thousandSeparator'=>'.');
        /**
         * Formats the value as a number using PHP number_format() function.
         * new: if the given $value is null/empty, return null/empty string
         * @param mixed $value the value to be formatted
         * @return string the formatted result
         * @see numberFormat
         */
        public function formatNumber($value) {
            if($value === null) return null;    // new
            if($value === '') return '';        // new
            return $this->numberFormat['currencySimbol'].number_format($value, $this->numberFormat['decimals'], $this->numberFormat['decimalSeparator'], $this->numberFormat['thousandSeparator']);
            }

        /*
         * new function unformatNumber():
         * turns the given formatted number (string) into a float
         * @param string $formatted_number A formatted number 
         * (usually formatted with the formatNumber() function)
         * @return float the 'unformatted' number
         */
        public function unformatNumber($formatted_number) {
            if($formatted_number === null) return null;
            if($formatted_number === '') return '';
            if(is_float($formatted_number)) return $formatted_number; // only 'unformat' if parameter is not float already

            $value = str_replace($this->numberFormat['currencySimbol'], '', $formatted_number);
            $value = str_replace($this->numberFormat['thousandSeparator'], '', $value);
            $value = str_replace($this->numberFormat['decimalSeparator'], '.', $value);
            return (float) $value;
        }
        
	public function formatBooleanState($value){
		return $value ? Yii::t('app', $this->booleanState[1]) : Yii::t('app',$this->booleanState[0]);
	}
	public function formatBoolean($value){
		return $value ? Yii::t('app', $this->booleanFormat[1]) : Yii::t('app',$this->booleanFormat[0]);
	}
}