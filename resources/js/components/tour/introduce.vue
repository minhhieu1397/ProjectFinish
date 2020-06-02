<template>
    <div class="row">
        <div class="col-md-2 offset-md-1 pl-3 TNR introduce-list">
            <hr>
            <h5>NHỮNG CON SỐ THỐNG KÊ</h5>
            <hr>
            <h5><i class="nav-icon fas fa-archway"></i>&nbsp;THÀNH LẬP NĂM 1956</h5>
            <hr>
            <h5><i class="nav-icon fas fa-graduation-cap"></i>&nbsp;ĐÀO TẠO</h5>
            &emsp; &emsp; &#9679; &nbsp;Đào tạo trên 40.000 sinh viên, học viên cao học và nghiên cứu sinh. <br>
            &emsp; &emsp; &#9679; &nbsp;67 chuyên ngành đại học, 33 chuyên ngành cao học và 57 chuyên ngành tiến sĩ.
            <hr>
            <h5><i class="nav-icon fas fa-hands-helping"></i>&nbsp;HỢP TÁC</h5>
            &emsp; &emsp; &#9679; &nbsp;Hợp tác với trên 200 trường Đại học, Trung tâm nghiên cứu khoa học và tổ chức Giáo dục của 32 quốc gia.<br>
            &emsp; &emsp; &#9679; &nbsp;500 cán bộ, sinh viên học tập, nghiên cứu, trao đổi quốc tế.
        </div>
        <div class="col-md-6 text-center">
            <h1 class="text-center headeing">GIỚI THIỆU</h1>
            <br>
            <br>
            <img class="pl-3" height="600px" width="950px" v-bind:src="'/image/introduce/hust1.jpg'">
            <br>
            <br>
        </div>
        <div class="col-md-6 offset-md-3 TNR introduce-body">
            <div>
                <span> &emsp; &emsp;Trường Đại học Bách khoa Hà Nội là trường đại học đa ngành về kỹ thuật được thành lập ngày 15 tháng 10 năm 1956.
                     Trường luôn là một trong những trường đại học kỹ thuật hàng đầu của nền giáo dục Việt Nam.
                      Với nhiều đóng góp cho công cuộc xây dựng và bảo vệ Tổ quốc,
                     Trường đã được Đảng và Nhà nước tặng nhiều danh hiệu và phần thưởng quý giá cho các cá nhân và tập thể Trường.</span>
                <br><br>
                <span>Tên tiếng Việt: <strong>Trường Đại học Bách khoa Hà Nội.</strong></span> <br>
                <span>Tên tiếng Anh: <strong>Hanoi University of Science and Technology.</strong></span> <br>
                <span>Địa chỉ: <strong>Số 01, Đại Cồ Việt, Hai Bà Trưng, Hà Nội.</strong></span> <br>
                <span >Tên tiếng Việt: <strong>Trường Đại học Bách khoa Hà Nội.</strong></span> <br><br>
                <strong>Cơ sở vật chất:</strong><br>
                	&emsp; &emsp; &#9679; &nbsp; Khuôn viên Trường có tổng diện tích 26 ha (lớn nhất trong các trường đại học khu vực nội thành Hà Nội) <br>
                	&emsp; &emsp; &#9679; &nbsp; Thư viện điện tử Tạ Quang Bửu với diện tích 37.000 m2, có thể phục vụ đồng thời 2.000 sinh viên với 600.000 cuốn sách, 130.000 đầu sách điện tử. Sinh viên được  truy cập miễn phí  CSDL từ các nguồn như Science Driect, Scopus…<br>
                	&emsp; &emsp; &#9679; &nbsp; Hệ thống 400 phòng học và phòng thí nghiệm, trong đó có 12 phòng thí nghiệm trọng điểm và đầu tư tập trung, phục vụ hiệu quả công tác đào tạo và nghiên cứu.<br>
                	&emsp; &emsp; &#9679; &nbsp; Toàn bộ giảng đường được trang bị đầy đủ điều hòa và thiết bị giảng dạy cùng với hệ thống wifi miễn phí trong khuôn viên Trường.<br>
                	&emsp; &emsp; &#9679; &nbsp; Trung tâm ký túc xá khang trang đáp ứng nhu cầu lưu trú của gần 4.500 sinh viên.<br>
                	&emsp; &emsp; &#9679; &nbsp; Khu liên hợp thể thao có diện tích 20.000 m2 với hệ thống cơ sở vật chất hiện đại, bao gồm: sân bóng, bể bơi, sân tennis tiêu chuẩn quốc gia và nhà thi đấu đa năng tiêu chuẩn Đông Nam Á.<br>
                	&emsp; &emsp; &#9679; &nbsp; Trung tâm Y tế hoạt động theo mô hình phòng khám đa khoa chăm sóc sức khỏe thường xuyên cho các cán bộ và sinh viên Trường.<br>
                    <br>
                    <br>
                    <br>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        data() {
           return {
           }
        },
        created() {
            this.getJwt();
        },
        methods: {
          
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
