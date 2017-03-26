<?php
$paper_id = $this->paper_id;
$paperObj = new admin_paper_paperBase();
//获得试卷相关信息
$paperInfo = $paperObj->getPaperByPaperPk($paper_id);
if(!is_array($paperInfo) || empty($paperInfo)) exit('试卷不存在');
//获得试卷试题，每条记录都包含了试卷，试卷题型，试卷试题的信息
$paperQsnTypeQsn = $paperObj->getPaperQuestionByPaperPk($paper_id);
?>

<?php
$this->printHead(
    array(
        'title' => array('title'=>'试题预览', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array(//加载css
            '/paper/layout.css'
            ,'/paper/main.css'
        )
    )
);
?>

<div id="container" class="box block_12">
	<div class="box_inner">
		<!-- // main：layout_full_width样式启用时是通栏宽度且slidbar是隐藏的 -->
		<div id="main_body" class="exam_paper layout_full_width">
			<!-- // main content -->
			<div id="content">
				<!-- // 试卷顶部 -->
				<div class="paper_header">
					<div class="col_right" style="margin-left:0px;">
						<h1>试卷名称：2011综合类行政考试</h1>
						<div class="left">
							<ul>
								<li><a class="" href="">试题总数：<?php echo $paperInfo['papr_qsn_count']; ?></a></li>
							</ul>
						</div>
						<div class="right">
							<ul>
								<li><a class="" href="">试卷总分：<?php echo $paperInfo['papr_point']; ?>分</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<!-- // 试卷模板内容 -->
				<div class="paper_content">
					<!-- // 大题内容：选择题 -->
<?php
$paperQsnTypeNo = '';//试卷题型编号：010101, 010102, ......
$paperQsnTypeTitle = '';//试卷题型标题
$paperQsnTypeNum = 0;//试卷题型题号：1,2, ......
$paperQsnNumFirst = 0;//试卷试题的第一级试题的题型号：1, 2, ......
$paperQsnNumSecond = 0;//试卷试题的第二级试题的题号：1, 2, ......
$paperQsnNumThird = 0;//试卷试题的第三级试题的题号：1, 2, ......


foreach($paperQsnTypeQsn as $qsn){
    //需要特殊处理的字段
    $qsn['qsn_content'] = htmlspecialchars_decode($qsn['qsn_content']);
    
    //如果符合以下三个条件之一即是输出新题型
    if($paperQsnTypeNo == '' || $paperQsnTypeTitle != $qsn['papr_qsn_type_title'] || $paperQsnTypeNo != $qsn['papr_qsn_type']){
        $paperQsnTypeNum++;
        
        $paperQsnNumFirst = 0;
        $paperQsnNumSecond = 0;
        $paperQsnNumThird = 0;
?>
					<div class="paper_list">
						<h1 class="title_level_1"><?php //echo $paperQsnTypeNum; ?> <?php echo $qsn['papr_qsn_type_title']; ?></h1>
<?php
    }
    
    if(count($paperQsnTypeQsn) <= 1){
        break;
    }
    
    $paperQsnNumFirst++;
    switch($qsn['papr_qsn_type']){
        case '010101' : 
            //获得单选题的选项
            $option = $paperObj->getPaperQuestionOption($qsn);
?>
						<!-- // 试题 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<?php echo $qsn['qsn_content']; ?>
											</div>
											<!-- // 答题内容 -->
											<div class="qt_content">
<?php
            foreach($option as $otn){
                $otn['option_content'] = htmlspecialchars_decode($otn['option_content']);
?>
												<dl class="qt_exam_title">
													<dt><input class="radiobox" name="radio1" type="radio" value="radio" /></dt>
													<dd>
														<div class="qt_c">
															<span><?php echo $otn['qsn_item_tag']; ?>.</span>
															<span><?php echo $otn['option_content']; ?></span>
														</div>
													</dd>
												</dl>
<?php
            }
?>
											</div>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php
        break;
        case '010102' : 
            //获得多选题的选项
            $option = $paperObj->getPaperQuestionOption($qsn);
?>
                        <!-- // 试题 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<?php echo $qsn['qsn_content']; ?>
											</div>
											
											<!-- // 答题内容 -->
											<div class="qt_content">
<?php
            foreach($option as $otn){
                $otn['option_content'] = htmlspecialchars_decode($otn['option_content']);
?>
												<dl class="qt_exam_title">
													<dt><input class="radiobox" name="radio1" type="checkbox" value="radio" /></dt>
													<dd>
														<div class="qt_c">
															<span><?php echo $otn['qsn_item_tag']; ?>.</span>
															<span><?php echo $otn['option_content']; ?></span>
														</div>
													</dd>
												</dl>
<?php
            }
?>
											</div>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
        break;
        case '010103' : 
?><!-- // 试题 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<?php echo $qsn['qsn_content']; ?>
											</div>
											<!-- // 答题内容 -->
											<div class="qt_content">
												<label><input class="radiobox" name="radio1" type="radio" value="radio" />A.正确</label>
												<label><input class="radiobox" name="radio1" type="radio" value="radio" />B.错误</label>
											</div>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
        break;
        case '010104' : 
?>
                        <!-- // 试题 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<?php echo $qsn['qsn_content']; ?>
											</div>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
        break;
        case '010105' : 
        case '010106' : 
            if($paperObj->hasChildren($qsn['qsn_sub_id'])){
?>
                        <!-- // 试题2 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<h1><?php echo $qsn['qsn_content']; ?></h1>
											</div>
<?php
                $subQsn = $paperObj->getPaperQuestionSubQsn($qsn);
                $paperQsnNumSecond = 0;
                foreach($subQsn as $sQsn){
                    $sQsn['qsn_content'] = htmlspecialchars_decode($sQsn['qsn_content']);
                    $paperQsnNumSecond++;
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none" style="clear:both;">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?></h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="">
														<?php echo $sQsn['qsn_content']; ?>
													</div>
													<div class="textareaHolder"><!-- // 文本框 -->
														<div class="textarea_inner">
															<textarea class="input_bg1 auto_width" rows=""></textarea>
														</div>
													</div>
												</div>
											</div>
<?php
                }
?>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
            }else{
?>
                        <!-- // 试题1 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="qt_title">
											<h1><?php echo $qsn['qsn_content']; ?></h1>
										</div>
										<!-- // 答题内容 -->
										<div class="qt_content ~none">
											<div class="textareaHolder"><!-- // 文本框 -->
												<div class="textarea_inner">
													<textarea class="input_bg1 auto_width" rows=""></textarea>
												</div>
											</div>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
            }
        break;
        case '010107' : 
?>
						<!-- // 试题 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<?php echo $qsn['qsn_content']; ?>
											</div>
<?php
            $paperQsnNumSecond = 0;
            $subQsn = $paperObj->getPaperQuestionSubQsn($qsn);
            foreach($subQsn as $sQsn){
                $sQsn['qsn_content'] = htmlspecialchars_decode($sQsn['qsn_content']);
                $paperQsnNumSecond++;
                switch($sQsn['qsn_type']){
                    case '010101' : 
?>
										
											<!-- // 答题内容 -->
											<div class="qt_content ~none">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="content">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
														
														<!-- // 答题内容 -->
														<div class="qt_content">
<?php
                        $subOption = $paperObj->getPaperQuestionOption($sQsn);
                        foreach($subOtn as $sOtn){
?>
												<dl class="qt_exam_title">
													<dt><input class="radiobox" name="radio1" type="radio" value="radio" checked="" /></dt>
													<dd>
														<div class="qt_c">
															<span><?php echo $sOtn['qsn_item_tag']; ?>.</span>
															<span><?php echo $sOtn['option_content']; ?></span>
														</div>
													</dd>
												</dl>
<?php
                        }
?>
														</div>
													</div>
												</div>
											</div>
<?php
                    break;
                    case '010102' : 
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="content">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
														
														<!-- // 答题内容 -->
														<div class="qt_content">
<?php
                        $subOption = $paperObj->getPaperQuestionOption($sQsn);
                        foreach($subOtn as $sOtn){
?>
												<dl class="qt_exam_title">
													<dt><input class="radiobox" name="radio1" type="radio" value="radio" checked="" /></dt>
													<dd>
														<div class="qt_c">
															<span><?php echo $sOtn['qsn_item_tag']; ?>.</span>
															<span><?php echo $sOtn['option_content']; ?></span>
														</div>
													</dd>
												</dl>
<?php
                        }
?>
														</div>
													</div>
												</div>
											</div>
<?php
                    break;
                    case '010103' : 
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="content">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
														
														<!-- // 答题内容 -->
														<div class="qt_content ~none">
															<label><input class="radiobox" name="radio1" type="radio" value="radio" checked="" />A.正确</label>
															<label><input class="radiobox" name="radio1" type="radio" value="radio" checked="" />B.错误</label>
														</div>
													</div>
												</div>
											</div>
											
<?php
                    break;
                    case '010104' : 
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="content">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
													</div>
												</div>
											</div>
<?php
                    break;
                    case '010105' : 
                    case '010106' : 
                        if($paperObj->hasChildren($sQsn['qsn_sub_id'])){
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none" style="clear:both;">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="content">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
<?php
                            $paperQsnNumThird = 0;
                            $grandsonQsn = $paperObj->getPaperQuestionSubQsn($sQsn);
                            foreach($grandsonQsn as $gsQsn){
                                $gsQsn['qsn_content'] = htmlspecialchars_decode($gsQsn['qsn_content']);
                                $paperQsnNumThird++;
?>
														<!-- // 答题内容 -->
														<div class="qt_content">
															<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . <?php echo $paperQsnNumThird; ?> . </h1>
															<span class="score"><?php echo $gsQsn['question_point']; ?>分</span>
    														<div class="qt_title">
    															<?php echo $gsQsn['qsn_content']; ?>
    														</div>
															<div class="textareaHolder"><!-- // 文本框 -->
																<div class="textarea_inner">
																	<textarea class="input_bg1 auto_width" rows=""></textarea>
																</div>
															</div>
														</div>
<?php
                            }
?>
													</div>
												</div>
											</div>
<?php
                        }else{
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none" style="clear:both;">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="content">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
													</div>
													<div class="textareaHolder"><!-- // 文本框 -->
														<div class="textarea_inner">
															<textarea class="input_bg1 auto_width" rows=""></textarea>
														</div>
													</div>
												</div>
											</div>
<?php
                        }
                    break;
                    case '010108' : 
?>
											<!-- // 答题内容 -->
											<div class="qt_content ~none">
												<div class="qt_title qt_title_sub">
													<h1><?php echo $paperQsnNumFirst; ?> . <?php echo $paperQsnNumSecond; ?> . </h1>
													<span class="score"><?php echo $sQsn['question_point']; ?>分</span>
													<hr>
													<div class="">
														<!-- // 试题内容 -->
														<div class="qt_title">
															<?php echo $sQsn['qsn_content']; ?>
														</div>
													</div>
												</div>
											</div>
<?php
                    break;
                    default :
                    break;
                }
            }
?>
											
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
        break;
        case '010108' : 
?>
                        <!-- // 试题 -->
						<div class="qt">
							<div class="qt_main">
								<div class="inner">
									<div class="col_left">
										<h1 class="num"><?php echo $paperQsnNumFirst; ?></h1>
										<h3 class="score"><?php echo $qsn['question_point']; ?>分</h3>
									</div>
									<div class="col_right">
										<!-- // 试题内容 -->
										<div class="content">
											<div class="qt_title">
												<?php echo $qsn['qsn_content']; ?>
											</div>
										</div>
									</div>
								</div><!-- // inner end -->
							</div>
						</div>
<?php 
        break;
        default : 
?>
<?php 
        break;
    }
    
    //如果符合以下三个条件之一即是输出新题型
    if($paperQsnTypeNo == '' || $paperQsnTypeTitle != $qsn['papr_qsn_type_title'] || $paperQsnTypeNo != $qsn['papr_qsn_type']){
?>	
					</div>
<?php
    }
    
    $paperQsnTypeNo = $qsn['papr_qsn_type'];
    $paperQsnTypeTitle = $qsn['papr_qsn_type_title'];
}
?>
				</div>
			</div>
		</div>
		<!-- // main_body end -->
	</div><!-- // box_inner -->
	<div class="clear"></div>
	<div id="footer">Powered by Orivon</div>
</div>