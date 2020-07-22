function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        var iFileSize = oInput.size;
         if (sFileName.length > 0) {
            var blnValid = false;
            var _validFileExtensions = ".pdf";
            console.log(_validFileExtensions);
                if (sFileName.substr(sFileName.length - _validFileExtensions.length,  _validFileExtensions.length).toLowerCase() ==  _validFileExtensions.toLowerCase() && iFileSize < 10485760) {
                    blnValid = true;
                }
            if (!blnValid) {
                alert("Please make sure your file is in pdf format and less than 10 MB");
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}