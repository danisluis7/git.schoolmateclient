
$.validator.addMethod("lettersOnly", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z âấầậẩẫăắằẳẵặêềếểễệìíỉĩịôồốổỗộơờớởỡợưứừửữựúùủũụýỳỹỷỵÂẤẦẨẪẬĂẰẮẶẲẴÊỀẾỂỄỆÌÍỈĨỊÔỐỒỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỨỪỬỮỰÝỲỶỸỴĐ]+$/);
}, "Letters only please");

$.validator.addMethod("phoneNumber", function(value, element) {
    return this.optional(element) || value == value.match(/^[0-9+]+$/);
}, "This is not phone number format");