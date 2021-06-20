<?php
#print_r($expenditure_type);
?>
<div class="container-fluid my_expenditure">

	<!-- 달력 -->
	<div class="row justify-content-center calendar">
    <div class="col col-lg-8">
			<div id='calendar'></div>
    </div>
  </div>
	
	<!-- 차트 -->
	<div class="row justify-content-center mt-5">
		<div class="col col-lg-8">
			<div id="chart"></div>
		</div>
	</div>

	<div class="row justify-content-center mt-5">
		<div class="col col-lg-8">
			<div id="list" style="display: flex; justify-content: space-around;"></div>
		</div>
	</div>

</div>

<!-- 지출 추가 -->
<form action="expenditure/insert" method="post" onsubmit="return mIdxCheck(this)">
	<input type="hidden" id="m_idx" name="m_idx" value="<?php if(isset($_COOKIE['m_idx'])) echo $_COOKIE['m_idx']; ?>">
	<div class="modal fade" id="expenditure_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">

					<div class="row align-items-center">
						<div class="col">
							<label class="form-check-label" for="date">날짜</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="date" id="date" name="date" value="<?=date("Y-m-d")?>" max="9999-12-31" required>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="method">수입/지출</label>
						</div>
						<div class="col-auto d-flex">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="income_expenditure" id="flexRadioDefault1" value="income">
								<label class="form-check-label" for="flexRadioDefault1">
									수입
								</label>
							</div>
							<div class="form-check ms-2">
								<input class="form-check-input" type="radio" name="income_expenditure" id="flexRadioDefault2" value="expenditure" checked>
								<label class="form-check-label" for="flexRadioDefault2">
									지출
								</label>
							</div>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="method">방식</label>
						</div>
						<div class="col-auto">
							<select class="form-select" id="method" name="method" aria-label="Default select example" required>
								<option value="" selected>선택</option>
								<option value="card">카드</option>
								<option value="cash">현금</option>
							</select>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="type">유형</label>
						</div>
						<div class="col-auto">
							<select class="form-select" id="type" name="type" aria-label="Default select example" required>
								<option value="" selected>선택</option>
								<?php foreach($expenditure_type as $value) { ?>
								<option value="<?=$value['idx']?>"><?=$value['name']?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="amount">금액</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="text" id="amount" name="amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" style="text-align: right;" required>
						</div>
					</div>					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
					<button type="submit" class="btn btn-primary">등록</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- event click -->
<form action="expenditure/update" method="post" onsubmit="return mIdxCheck2(this)">
	<input type="hidden" id="idx2" name="idx">
	<input type="hidden" id="m_idx2" name="m_idx" value="<?php if(isset($_COOKIE['m_idx'])) echo $_COOKIE['m_idx']; ?>">
	<div class="modal fade" id="expenditure_modal2" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">

					
					<div class="row align-items-center">
						<div class="col">
							<label class="form-check-label" for="date">날짜</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="date" id="date2" name="date" value="<?=date("Y-m-d")?>" max="9999-12-31" required>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="method">수입/지출</label>
						</div>
						<div class="col-auto d-flex">
							<div class="form-check">
								<input class="form-check-input income_expenditure" type="radio" name="income_expenditure" id="flexRadioDefault1" value="income">
								<label class="form-check-label" for="flexRadioDefault1">
									수입
								</label>
							</div>
							<div class="form-check ms-2">
								<input class="form-check-input income_expenditure" type="radio" name="income_expenditure" id="flexRadioDefault2" value="expenditure" checked>
								<label class="form-check-label" for="flexRadioDefault2">
									지출
								</label>
							</div>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="method2">방식</label>
						</div>
						<div class="col-auto">
							<select class="form-select" id="method2" name="method" aria-label="Default select example" required>
								<option value="" selected>선택</option>
								<option value="card">카드</option>
								<option value="cash">현금</option>
							</select>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="type2">유형</label>
						</div>
						<div class="col-auto">
							<select class="form-select" id="type2" name="type" aria-label="Default select example" required>
								<option value="" selected>선택</option>
								<?php foreach($expenditure_type as $value) { ?>
								<option value="<?=$value['idx']?>"><?=$value['name']?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="amount2">금액</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="text" id="amount2" name="amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" style="text-align: right;" required>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
					<button type="submit" class="btn btn-primary">수정</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
const mIdx = document.getElementById('m_idx').value;

// fullCalendar
const calendarEl = document.getElementById('calendar');
const calendar = new FullCalendar.Calendar(calendarEl, {
	locale: 'ko',
	initialView: 'dayGridMonth',
	headerToolbar: {
		start: "addEventButton",
		center: "prev title next",
		end: "today",
	},
	titleFormat: function(date) {
		return `${date.date.year}년 ${date.date.month + 1}월`;
	},
	fixedWeekCount: false,
	showNonCurrentDates: false,
	events: {
		url: "expenditure/get_expenditure",
		method: "GET",
		failure: function () {
			//alert("there was an error while fetching events!");
		}
	},
	// 수입 지출 추가 버튼
	customButtons: {
		addEventButton: {
			text: '수입/지출 추가',
			click: function() {
				myModal.show();
			}
		}
	},
	// 이벤트 클릭시
	eventClick: function(info) {
		fetch('/expenditure/get_one_expenditure', {
			method: 'post',
			headers: {'Content-Type': 'application/json'},
			body: JSON.stringify({
				"idx": info.event._def.extendedProps.idx
			})
		})
		.then(res => res.json())
		.then((data) => {
			document.getElementById("idx2").value = data[0]['idx'];
			document.getElementById("date2").value = data[0]['date'];
			document.getElementById('amount2').value = data[0]['amount'];
			document.getElementById('method2').value = data[0]['method'];
			document.getElementById('type2').value = data[0]['et_idx'];
			let incomeExpenditure = document.querySelectorAll(".income_expenditure");
			for(let i = 0; i < incomeExpenditure.length; i++) {
				if(incomeExpenditure[i].value === data[0]['income_expenditure']) {
					incomeExpenditure[i].checked = true;
				}
			}
		})
		.catch(error => console.error('Error:', error));

		myModal2.show();
	},
	height: "auto",
	eventDisplay: 'block',
	displayEventTime: false,
	eventColor: 'rgba(0, 0, 0, 0)',
	eventTextColor: '#000000',
	
});
calendar.render();

// calendar event button 버튼 클릭 시
let calendarEventButtons = document.querySelectorAll('.fc-prev-button, .fc-next-button, .fc-today-button');

calendarEventButtons.forEach((e) => {
	e.addEventListener('click', function() {
		let date = yearMonthFormat(calendar.getDate());
		
		// 차트 data
		if(mIdx !== "") {
			// chart data
			fetch('/expenditure/get_chart_expenditure', {
				method: 'post',
				headers: {'Content-Type': 'application/json'},
				body: JSON.stringify({
					'm_idx': mIdx,
					'date': date
				})
			})
			.then(res => res.json())
			.then((data) => {

				let dataArray = new Array();

				for(let i = 0; i < data.length; i++) {
					let tmpData = [data[i]['name'], data[i]['amount']];
					dataArray.push(tmpData);
				}

				if(isEmptyArr(dataArray)) {
					let tmpData = ["지출이 없어요.", 1];
					dataArray.push(tmpData);
				}

				const chart = bb.generate({
					data: {
						columns: dataArray,
						type: "donut"
					},
					donut: {
						title: "내 지출"
					},
					bindto: "#chart"
				})
			})
			.catch(error => console.error('Error:', error));

			// list data
			fetch('/expenditure/get_list_expenditure', {
				method: 'post',
				headers: {'Content-Type': 'application/json'},
				body: JSON.stringify({
					'm_idx': mIdx,
					'date': date
				})
			})
			.then(res => res.json())
			.then((data) => {
				// 모든 자식 요소 제거
				removeAllChild(document.getElementById('list'));

				let dataArray = new Array();		
				dataArray.push(data['expenditure'], data['income']);

				// 배열이 비어 있다면 미출력
				if(isEmptyArr(dataArray[0]) && isEmptyArr(dataArray[1])) {
					
				}else{
					let div = document.createElement('div');
					let h5 = document.createElement('h5');
					h5.innerText = "지출";
					div.append(h5);
					for(let i = 0; i < dataArray[0].length; i++) {
						let h6 = document.createElement('h6');
						let span1 = document.createElement('span');
						let span2 = document.createElement('span');
						span1.innerText = dataArray[0][i]['name']+": ";
						span2.innerText = new Intl.NumberFormat().format(dataArray[0][i]['amount'])+"원";
						h6.append(span1);
						h6.append(span2);
						div.append(h6);
					}
					document.getElementById('list').append(div);

					let div2 = document.createElement('div');
					let h52 = document.createElement('h5');
					h52.innerText = "수입";
					div2.append(h52);
					for(let i = 0; i < dataArray[1].length; i++) {
						let h6 = document.createElement('h6');
						let span1 = document.createElement('span');
						let span2 = document.createElement('span');
						span1.innerText = dataArray[1][i]['name']+": ";
						span2.innerText = new Intl.NumberFormat().format(dataArray[1][i]['amount'])+"원";
						h6.append(span1);
						h6.append(span2);
						div2.append(h6);
					}
					document.getElementById('list').append(div2);
				}
				
			})
			.catch(error => console.error('Error:', error));
		}
	})
})

// 지출 data
if(mIdx !== "") {
	fetch('/expenditure/get_chart_expenditure', {
		method: 'post',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify({
			'm_idx': mIdx,
			'date': yearMonthFormat(new Date())
		})
	})
	.then(res => res.json())
	.then((data) => {

		let dataArray = new Array();

		for(let i = 0; i < data.length; i++) {
			let tmpData = [data[i]['name'], data[i]['amount']];
			dataArray.push(tmpData);
		}

		if(isEmptyArr(dataArray)) {
			let tmpData = ["지출이 없어요.", 1];
			dataArray.push(tmpData);
		}

		const chart = bb.generate({
			data: {
				columns: dataArray,
				type: "donut"
			},
			donut: {
				title: "내 지출"
			},
			bindto: "#chart"
		})
	})
	.catch(error => console.error('Error:', error));

	// list data
	fetch('/expenditure/get_list_expenditure', {
		method: 'post',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify({
			'm_idx': mIdx,
			'date': yearMonthFormat(new Date())
		})
	})
	.then(res => res.json())
	.then((data) => {

		// 모든 자식 요소 제거
		removeAllChild(document.getElementById('list'));
		
		let dataArray = new Array();		
		dataArray.push(data['expenditure'], data['income']);

		// 배열이 비어 있다면 미출력
		if(isEmptyArr(dataArray[0]) && isEmptyArr(dataArray[1])) {
			
		}else{
			let div = document.createElement('div');
			let h5 = document.createElement('h5');
			h5.innerText = "지출";
			div.append(h5);
			for(let i = 0; i < dataArray[0].length; i++) {
				let h6 = document.createElement('h6');
				let span1 = document.createElement('span');
				let span2 = document.createElement('span');
				span1.innerText = dataArray[0][i]['name']+": ";
				span2.innerText = new Intl.NumberFormat().format(dataArray[0][i]['amount'])+"원";
				h6.append(span1);
				h6.append(span2);
				div.append(h6);
			}
			document.getElementById('list').append(div);

			let div2 = document.createElement('div');
			let h52 = document.createElement('h5');
			h52.innerText = "수입";
			div2.append(h52);
			for(let i = 0; i < dataArray[1].length; i++) {
				let h6 = document.createElement('h6');
				let span1 = document.createElement('span');
				let span2 = document.createElement('span');
				span1.innerText = dataArray[1][i]['name']+": ";
				span2.innerText = new Intl.NumberFormat().format(dataArray[1][i]['amount'])+"원";
				h6.append(span1);
				h6.append(span2);
				div2.append(h6);
			}
			document.getElementById('list').append(div2);
		}

	})
	.catch(error => console.error('Error:', error));

}else{
	const chart = bb.generate({
		data: {
			columns: [
				['카페', 1],
				['병원', 1],
				['외식', 1]				
			],
			type: "donut"
		},
		donut: {
			title: "로그인/회원가입\n먼저 진행해 주세요."
		},
		bindto: "#chart"
	})
}

// bootstrap5
const myModal = new bootstrap.Modal(document.getElementById('expenditure_modal'), {
	keyboard: true
});

const myModal2 = new bootstrap.Modal(document.getElementById('expenditure_modal2'), {
	keyboard: true
});

// mIdxCheck
function mIdxCheck(obj) {
	// console.log(obj.m_idx);
	if(obj.m_idx.value === "") {
		alert("로그인/회원가입을 먼저 진행해 주세요.");
		return false;
	}
}

// mIdxCheck2
function mIdxCheck2(obj) {
	// console.log(obj.m_idx);
	if(obj.m_idx.value === "") {
		alert("로그인/회원가입을 먼저 진행해 주세요.");
		return false;
	}	
}

</script>