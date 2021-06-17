<?php
#print_r($_GET);
?>
<div class="container-fluid my_calendar">
  <div class="row justify-content-center calendar">
    <div class="col col-lg-8">
			<div id='calendar'></div>
    </div>
  </div>
</div>

<!-- 일정 추가 -->
<form action="calendar/insert" method="post" onsubmit="return mIdxCheck(this)">
	<input type="hidden" name="m_idx" value="<?php if(isset($_COOKIE['m_idx'])) echo $_COOKIE['m_idx']; ?>">
	<input type="hidden" id="date_type" name="date_type" value="datetime-local">
	<div class="modal fade" id="calendar_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<label for="title" class="col-form-label">제목</label>
						</div>
						<div class="col">
							<input type="text" id="title" name="title" class="form-control">
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="all_day">하루 종일</label>
						</div>
						<div class="col-auto">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="all_day" onchange="allDay(this)">
							</div>
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="sdate">시작</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="datetime-local" id="sdate" name="sdate" value="<?=date("Y-m-d\TH:i")?>">
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="edate">종료</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="datetime-local" id="edate" name="edate" value="<?=date("Y-m-d\TH:i")?>">
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<textarea class="form-control" name="memo" placeholder="메모" style="height: 100px"></textarea>
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="color">색</label>
						</div>
						<div class="col-auto">
							<div id="color-picker"></div>
							<input type="hidden" id="color" name="color" value="#ffca2c">
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
<form action="calendar/update" method="post" onsubmit="return mIdxCheck2(this)">
	<input type="hidden" id="idx2" name="idx">
	<input type="hidden" name="m_idx" value="<?php if(isset($_COOKIE['m_idx'])) echo $_COOKIE['m_idx']; ?>">
	<input type="hidden" id="m_idx2" name="m_idx2" value="">
	<input type="hidden" id="date_type2" name="date_type" value="datetime-local">
	<div class="modal fade" id="calendar_modal2" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<label for="title2" class="col-form-label">제목</label>
						</div>
						<div class="col">
							<input type="text" id="title2" name="title" class="form-control">
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="all_day2">하루 종일</label>
						</div>
						<div class="col-auto">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="all_day2" onchange="allDay2(this)">
							</div>
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="sdate2">시작</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="datetime-local" id="sdate2" name="sdate" value="<?=date("Y-m-d")?>T<?=date("H:i")?>">
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="edate2">종료</label>
						</div>
						<div class="col-auto">
							<input class="form-control" type="datetime-local" id="edate2" name="edate" value="<?=date("Y-m-d")?>T<?=date("H:i")?>">
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<textarea class="form-control" id="memo2" name="memo" placeholder="메모" style="height: 100px"></textarea>
						</div>
					</div>
					<div class="row align-items-center mt-3">
						<div class="col">
							<label class="form-check-label" for="color2">색</label>
						</div>
						<div class="col-auto">
							<div id="color-picker2"></div>
							<input type="hidden" id="color2" name="color">
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
// tui color-picker
const colorpicker = tui.colorPicker.create({
	container: document.getElementById('color-picker'),
	color: '#ffca2c'
});
colorpicker.on('selectColor', function(ev) {
	let color = document.getElementById('color');
	color.value = ev.color;
});

const colorpicker2 = tui.colorPicker.create({
	container: document.getElementById('color-picker2')
});
colorpicker2.on('selectColor', function(ev) {
	let color = document.getElementById('color2');
	color.value = ev.color;
});

// fullCalendar
const calendarEl = document.getElementById('calendar');
const calendar = new FullCalendar.Calendar(calendarEl, {
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
	dayHeaderContent: function (date) {
		let weekList = ["일", "월", "화", "수", "목", "금", "토"];
		return weekList[date.dow];
	},
	events: {
		url: "calendar/get_events",
		method: "GET",
		failure: function () {
			alert("there was an error while fetching events!");
		}
	},
	// 일정 추가 버튼
	customButtons: {
		addEventButton: {
			text: '일정 추가',
			click: function() {
				myModal.show();
			}
		}
	},
	// 일정 클릭시
	eventClick: function(info) {
		fetch('/calendar/get_one_event', {
			method: 'post',
			headers: {'Content-Type': 'application/json'},
			body: JSON.stringify({
				"idx": info.event._def.extendedProps.idx
			})
		})
		.then(res => res.json())
		.then((data) => {
			// date type check
			let idx = document.getElementById("idx2");
			let sdate = document.getElementById("sdate2");
			let edate = document.getElementById("edate2");
			let dateType = document.getElementById("date_type2");
			let color = document.getElementById("color2");
			let allDay = document.getElementById("all_day2");
			if(data[0]['date_type'] === "datetime-local") {
				allDay.checked = false;
				sdate.value = "";
				edate.value = "";
				dateType.value = "datetime-local";
				sdate.setAttribute("type", "datetime-local");
				edate.setAttribute("type", "datetime-local");
			}else if(data[0]['date_type'] === "date") {
				allDay.checked = true;
				sdate.value = "";
				edate.value = "";
				dateType.value = "date";
				sdate.setAttribute("type", "date");
				edate.setAttribute("type", "date");
			}
			idx.value = data[0]['idx'];
			document.getElementById('title2').value = data[0]['title'];
			sdate.value = data[0]['start'];
			edate.value = data[0]['end'];
			colorpicker2.setColor(data[0]['color']);
			color.value = data[0]['color'];
			document.getElementById('memo2').value = data[0]['memo'];
			document.getElementById('m_idx2').value = data[0]['m_idx'];
		})
		.catch(error => console.error('Error:', error));

		myModal2.show();
	},
	height: "auto"
});
calendar.render();

// bootstrap5
const myModal = new bootstrap.Modal(document.getElementById('calendar_modal'), {
	keyboard: true
});

const myModal2 = new bootstrap.Modal(document.getElementById('calendar_modal2'), {
	keyboard: true
});

// allDay
function allDay(value) {
	let sdate = document.getElementById("sdate");
	let edate = document.getElementById("edate");
	let dateType = document.getElementById("date_type");
	if(value.checked === true) {
		sdate.value = "";
		edate.value = "";
		dateType.value = "date";
		sdate.setAttribute("type", "date");
		edate.setAttribute("type", "date");
		sdate.value = dateFormat(new Date());
		edate.value = dateFormat(new Date());
	}else{
		sdate.value = "";
		edate.value = "";
		dateType.value = "datetime-local";
		sdate.setAttribute("type", "datetime-local");
		edate.setAttribute("type", "datetime-local");
		sdate.value = dateTimeFormat(new Date());
		edate.value = dateTimeFormat(new Date());
	}
}

// allDay2
function allDay2(value) {
	let sdate = document.getElementById("sdate2");
	let edate = document.getElementById("edate2");
	let dateType = document.getElementById("date_type2");
	if(value.checked === true) {
		sdate.value = "";
		edate.value = "";
		dateType.value = "date";
		sdate.setAttribute("type", "date");
		edate.setAttribute("type", "date");
		sdate.value = dateFormat(new Date());
		edate.value = dateFormat(new Date());
	}else{
		sdate.value = "";
		edate.value = "";
		dateType.value = "datetime-local";
		sdate.setAttribute("type", "datetime-local");
		edate.setAttribute("type", "datetime-local");
		sdate.value = dateTimeFormat(new Date());
		edate.value = dateTimeFormat(new Date());
	}
}

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

	if(obj.m_idx.value !== obj.m_idx2.value) {
		alert("작성자만 수정 가능합니다.");
		return false;
	}
}
</script>