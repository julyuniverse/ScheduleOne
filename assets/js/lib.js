// 10 이하 왼쪽 0 붙이기
function leftZero(value) {
	if(value >= 10) {
		return value;
	}
	return `0${value}`;
}

// year month format
function yearMonthFormat(source) {
	const year = source.getFullYear();
	const month = leftZero(source.getMonth()+1);

	return [year, month].join('-');
}


// date format
function dateFormat(source) {
	const year = source.getFullYear();
	const month = leftZero(source.getMonth()+1);
	const day = leftZero(source.getDate());

	return [year, month, day].join('-');
}

// datetime format
function dateTimeFormat(source) {
	const year = source.getFullYear();
	const month = leftZero(source.getMonth()+1);
	const day = leftZero(source.getDate());
	const hours = leftZero(source.getHours());
	const minutes = leftZero(source.getMinutes());

	let date = [year, month, day].join('-');
	return date+"T"+hours+":"+minutes;
}

// 빈 배열 확인
function isEmptyArr(arr) {
	if(Array.isArray(arr) && arr.length === 0) {
		return true;
	}
	return false;
}

// 모든 자식 요소 제거
function removeAllChild(parent) {
	while(parent.hasChildNodes()) {
	  parent.removeChild(parent.firstChild);
	}
}