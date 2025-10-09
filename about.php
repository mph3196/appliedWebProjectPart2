<?php
$currentPage = 'about';
$pageTitle = 'JSM About Us Page';
$pageDescription = 'About page for JSM University';
$pageHeading = 'About Us';

include 'header.inc';
include 'nav.inc';
?>


<h1><strong>Who are We</strong></h1> 
<!-- Used GenAI GPT5 for who are we section-->
<p class="aboutus">
At JSM University, we are more than just a place of learning—we are a community committed to shaping future leaders, innovators, and changemakers. Founded on the values of excellence, integrity, and inclusivity, JSM University provides a dynamic environment where students are empowered to explore their potential, challenge ideas, and make meaningful contributions to society.
Our academic programs are designed to blend cutting-edge knowledge with real-world application, ensuring our graduates are not only career-ready but also equipped to make a lasting impact in their chosen fields. With a dedicated faculty, modern facilities, and a culture that fosters creativity and collaboration, JSM University stands as a hub of knowledge, research, and innovation.
Above all, we are committed to nurturing minds and inspiring futures—helping every student discover their path and achieve their vision.</p>

<!--Group details section-->
<div class="containerdetails">
  <h2>GROUP Details</h2>
  <p><strong>Group Name:</strong>JSM</p>
  <p><Strong>Meeting Location:</Strong> John St, Hawthorn VIC 3122, BA513 Business & Arts</p>
  <p><strong>Lecturer:</strong> Dr. Atie Kia</p>
  <p><strong>Lab Tutor:</strong> Dr. Atie Kia</p>
  <p><strong>Meeting Times(Day & Time):</strong></p>
  <ul>
    <li>Tuesday
      <ul>
        <li>12:30PM – 2:30PM</li>
      </ul>
    </li>
    <li>Thursday
      <ul>
        <li>10:30AM – 12:30PM</li>
      </ul>
    </li>
  </ul>
<img src="images/group_photo.jpg" alt="JSM Team Photo" class="group-photo">
</div>

<!--Insight about our team-->
<h2 class="team"><strong>OUR TEAM</strong></h2>

  <!--Each member and their student ID-->
<aside id=teaminfo>
  <h3><strong>Student ID's</strong></h3>
  <ul>
    <li>Jonathon Taylor - 105118283</li>
    <li>Shaun Vambe - 105920789</li>
    <li>Morgan Hopkins - 106188591</li>
  </ul>
</aside>

  <div class="container">
    <div class="header"><strong>Jonathon</strong></div>
    <p>Jonathon is a 21 year old male and second year student from Melbourne Australia, he is currently pursuing a Bachelors Degree in Computer Science, majoring in Cyber Security</p>
    <p><strong>Role:</strong>Team Leader – keeping team on track to meet all set targets and deadlines</p>
    <p><strong>Role:</strong>Lead Designer – maintaining a consistent, uniform and professional style across all pages of the site</p><br>
    <p><strong>Contributions:</strong></p>
    <ul>
      <li><strong>Individual Responsibility:</strong>jobs.html</li>
      <li><strong>Shared Responsibilities:</strong>index.html, styles.css, Jira board</li>
    </ul>
    <p><strong>Favourite Hobbies:</strong></p>
    <ul>
      <li>Muay Thai</li>
      <li>Hiking</li>
      <li>Gaming</li>
      <li>Watching MMA</li>
    </ul>
    <p><strong>Favourite Language</strong>: Dutch </p>
    <p><strong>Famous Quote in Dutch:</strong> “Streef niet naar succes als dat is wat je wilt; gewoon doen waar je van houdt en in gelooft en de rest komt vanzelf.”</p>
  </div>
  
<div class="container">
    <div class="header"><strong>Shaun</strong></div>
    <p>Shaun is a 19 year old male first year student from Melbourne Australia, he is currently pursuing a Bachelors Degree in Data Science</p>
    <p><strong>Role:</strong>Communications Manager – organising communication between team members, setting times for meetings, convening with teacher (Atie)</p><br>
    <p><strong>Contributions:</strong></p>
    <ul>
      <li><strong>Individual Responsibility:</strong>about.html</li>
      <li><strong>Shared Responsibilities:</strong>index.html, styles.css, Jira board</li>
    </ul>
    <p><strong>Favourite Hobbies:</strong></p>
    <ul>
      <li>Gaming</li>
      <li>Reading</li>
      <li>Football(Soccer)</li>
      <li>Playing Sport</li>
    </ul>
    <p><strong>Favourite Language</strong>: Portuguese </p>
    <p><strong>Famous Quote in Portuguese:</strong> “A melhor vingança é ser diferente daquele que causou o dano.”
</p>
</div>

<div class="container">
    <div class="header"><Strong>Morgan</Strong></div>
    <p>Morgan is a 36 year old male first year student from Melbourne, Australia. He is currently pursuing a Bachelors Degree in Data Science</p>
    <p><strong>Role:</strong>Lead Developer – ensuring functional html, CSS etc., markup validity and proper documentation and commenting for all pages of the site </p><br>
    <p><strong>Contributions:</strong></p>
    <ul>
      <li><strong>Individual Responsibility:</strong>apply.html</li>
      <li><strong>Shared Responsibilities:</strong>index.html, styles.css, Jira board</li>
    </ul>
    <p><strong>Favourite Hobbies:</strong></p>
    <ul>
      <li>Gaming</li>
      <li>Cycling</li>
      <li>Drinking</li>
      <li>Dancing to Techno</li>
    </ul>
    <p><strong>Favourite Language</strong>: Mandarin </p>
    <p><strong>Favourite quote in Mandarin:</strong> “天下萬物都處於徹底的混亂之中;情況非常好。”
</div>

<!--Table of funfacts about the team-->
<h2 id="funfacts"><strong>Fun Facts</strong></h2>
  <div class="card" role="region" aria-label="Fun facts about three people">
<table class="funfacttable">
    <caption>Fun facts — facts about our team</caption>
    <tr>
      <th scope="col">Category</th>
      <th scope="col">Jonathan</th>
      <th scope="col">Shaun</th>
      <th scope="col">Morgan</th>
    </tr>
  <tbody>
    <tr>
      <th scope="row">Dream job</th>
      <td>Security Engineer</td>
      <td>Data scientist at a leading finance firm</td>
      <td>Cybernetic Systems Engineer</td>
    </tr>
    <tr>
      <th scope="row">Coding snack</th>
      <td>Coffee</td>
      <td>Coffee</td>
      <td>Whisky</td>
    </tr>
    <tr>
      <th scope="row">Hometown</th>
      <td>Bairnsdale, Australia</td>
      <td>Melbourne, Australia</td>
      <td>Chelsea Heights</td>
    </tr>

    <tr>
      <th scope="row">Favourite language</th>
      <td>C#</td>
      <td>HTML</td>
      <td>Python</td>
    </tr>

    <tr>
      <th scope="row">Fun fact</th>
      <td class="funfact">Train the combat sport of Muay Thai in Thailand</td>
      <td class="funfact">His favourite Batman comic is Dark Victory.</td>
      <td class="funfact">Cycled solo across England, Wales and Ireland</td>
    </tr>
  </tbody>
</table>
</div>

<?php include 'footer.inc'; ?>