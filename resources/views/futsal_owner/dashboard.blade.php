@extends('futsal_owner.inc.main')
@section('container')
    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <img src="#" alt="futsal_owner">
            </div>
        </div>

        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">5</div>
                    <div class="cardName">Total Courts</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="business-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">284</div>
                    <div class="cardName">Comments</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">12</div>
                    <div class="cardName">Pending Bookings</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="calendar-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">Rs. 1,00,000</div>
                    <div class="cardName">Earnings</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>



        <!-- ================ Booking Details List ================= -->
        <div class="details">
            <div class="recentBookings">
                <div class="cardHeader">
                    <h2>Recent Bookings</h2>
                    <a href="#" class="btn">View All</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Futsal</td>
                            <td>Price</td>

                            <td>Email ID</td> <!-- New column for Email ID -->
                            <td>Phone No.</td> <!-- New column for Phone Number -->
                            <td>Date</td>
                            <td>Status</td>
                            <td>Action</td>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ranipauwa Futsal Ground</td>
                            <td>Rs. 120,000</td>
                            <td>example1@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-04</td>
                            <td><span class="status active">Active</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td> <!-- Action column -->
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Matepani Futsal</td>
                            <td>Rs. 12,000</td>
                            <td>example2@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-03</td>
                            <td><span class="status inactive">Inactive</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Nayabazar Futsal Court</td>
                            <td>Rs. 120,000</td>
                            <td>example3@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-02</td>
                            <td><span class="status active">Active</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Pardi Futsal Arena</td>
                            <td>Rs. 62,000</td>
                            <td>example4@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-01</td>
                            <td><span class="status inactive">Inactive</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Nayabazar Futsal Court</td>
                            <td>Rs. 62,000</td>
                            <td>example5@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-01</td>
                            <td><span class="status active">Active</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Ranipauwa Futsal Ground</td>
                            <td>Rs. 62,000</td>
                            <td>example6@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-01</td>
                            <td><span class="status inactive">Inactive</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Ranipauwa Futsal Ground</td>
                            <td>Rs. 62,000</td>
                            <td>example6@email.com</td>
                            <td>9800000000</td>
                            <td>2025-02-01</td>
                            <td><span class="status inactive">Inactive</span></td>
                            <td><span class="action"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                            </td>
                        </tr>

                    </tbody>
                </table>



            </div>

            <!-- ================= New Customers ================ -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Recent Customers</h2>
                </div>

                <table>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>David Gurung <br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Amit Baral<br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Rani Gopal <br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Biswas Rana <br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Uma Goshi <br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Prabin Khatri <br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Ruma GC <br> <span>Nepal</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                        </td>
                        <td>
                            <h4>Sikshya Khatri <br> <span>Nepal</span></h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
