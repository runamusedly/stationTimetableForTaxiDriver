# 열차 시간표(stationTimeTable)
심플한 웹사이트 기반의 열차 시간표 조회 사이트입니다. 열차 시간표 자료는 코레일 공식 사이트에서 가져왔습니다.

## 주요기능
- 해당 지역의 역 이름별 시간표 조회
- 요일별로 구분된 시간표 조회

## 기술 스택
- HTML
- CSS
- JavaScript(첫 버전에서는 비중이 적음)
- PHP

## 스크린샷
<table>
  <tr>
    <td><p align="center"><img src="media/screen1.png" alt="real web site1" width="50%"></p></td>
    <td><p align="center"><img src="media/screen2.png" alt="real web site2" width="50%"></p></td>
  </tr>
</table>

## 설치 및 실행
- https://runamusedly.mycafe24.com/station/wonjusiStation/indexWonjusi.php (왼쪽 링크에서 실제 운영되는 웹사이트를 확인할 수 있습니다.)
- 데스크탑에서 설치 및 실행하려면 wamp server64와 같은 아파치 서버를 로컬에 설치하고 실행해야 작동여부와 결과물을 확인할 수 있습니다. 해당 코드에는 php코드가 포함되어 있어서 php 코드를 해석할 수 있는 서버가 필수입니다.
- 압축파일로 자신의 데스크탑에 다운받아서 실행하거나 수정할 수 있습니다. data, media, log폴더와 나머지 파일들이 서로 연결되어 있습니다.(상대경로) 특히 log폴더에는 현재 파일이 하나있지만 내용은 없습니다. 이는 GitHub에 업로드 할 때 빈 폴더만 생성할 수 없기 때문에 적절한 파일(비어있음)을 생성해 놓은 것입니다. 사실상, log폴더만 있으면 PHP코드가 시간별 방문자 데이터를 적절한 파일을 자동 생성하여 기록해 놓습니다.

- ## 라이선스
- MIT License를 사용합니다.
